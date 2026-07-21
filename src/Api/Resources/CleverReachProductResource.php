<?php

namespace CeresCoconut\Api\Resources;

use Ceres\Config\CeresGlobalConfig;
use IO\Helper\Utils;
use IO\Services\LocalizationService;
use Plenty\Modules\Webshop\ItemSearch\SearchPresets\SearchItems;
use Plenty\Modules\Webshop\ItemSearch\Services\ItemSearchService;
use Plenty\Plugin\ConfigRepository;
use Plenty\Plugin\Controller;
use Plenty\Plugin\Http\Request;
use Plenty\Plugin\Http\Response;

/**
 * Supplies PlentyONE products to CleverReach's MyContent product search.
 */
class CleverReachProductResource extends Controller
{
    /** @var Request */
    private $request;

    /** @var Response */
    private $response;

    /** @var ConfigRepository */
    private $config;

    /** @var ItemSearchService */
    private $itemSearchService;

    /** @var LocalizationService */
    private $localizationService;

    /** @var CeresGlobalConfig */
    private $ceresGlobalConfig;

    public function __construct(
        Request $request,
        Response $response,
        ConfigRepository $config,
        ItemSearchService $itemSearchService,
        LocalizationService $localizationService,
        CeresGlobalConfig $ceresGlobalConfig
    )
    {
        $this->request = $request;
        $this->response = $response;
        $this->config = $config;
        $this->itemSearchService = $itemSearchService;
        $this->localizationService = $localizationService;
        $this->ceresGlobalConfig = $ceresGlobalConfig;
    }

    /**
     * Handles both MyContent calls: get=filter and get=search.
     */
    public function store(): Response
    {
        if (!$this->isAuthorized())
        {
            return $this->response->json(['error' => 'Unauthorized'], 403);
        }

        $operation = strtolower(trim((string) $this->request->get('get', '')));

        if ($operation === 'filter')
        {
            return $this->response->json($this->getFilters(), 200);
        }

        if ($operation === 'search')
        {
            return $this->response->json($this->search(), 200);
        }

        return $this->response->json(['error' => 'Unknown MyContent operation'], 400);
    }

    private function isAuthorized(): bool
    {
        $expectedPassword = trim((string) $this->config->get('CeresCoconut.cleverreach.password', ''));
        $providedPassword = (string) $this->request->get('password', '');

        return $expectedPassword !== '' && hash_equals($expectedPassword, $providedPassword);
    }

    private function getFilters(): array
    {
        return [
            [
                'name' => 'Sprache',
                'description' => 'Sprache der PlentyONE-Artikeldaten',
                'required' => true,
                'query_key' => 'language',
                'type' => 'dropdown',
                'values' => [
                    ['text' => 'Deutsch', 'value' => 'de'],
                    ['text' => 'Englisch', 'value' => 'en']
                ]
            ],
            [
                'name' => 'Artikel',
                'description' => 'Artikelname, Artikel-ID oder Variantennummer',
                'required' => true,
                'query_key' => 'product',
                'type' => 'input'
            ]
        ];
    }

    private function search(): array
    {
        $query = trim((string) $this->request->get('product', ''));
        $language = strtolower(trim((string) $this->request->get('language', 'de')));

        if (!in_array($language, ['de', 'en'], true))
        {
            $language = 'de';
        }

        $settings = [
            'type' => 'product',
            'link_editable' => false,
            'link_text_editable' => true,
            'image_size_editable' => true
        ];

        if ($query === '')
        {
            return ['settings' => $settings, 'items' => []];
        }

        $this->localizationService->setLanguage($language, false);

        $itemsPerPage = (int) $this->config->get('CeresCoconut.cleverreach.itemsPerPage', 20);
        $itemsPerPage = max(1, min(50, $itemsPerPage));

        $options = [
            'query' => $query,
            'facets' => '',
            'sorting' => '',
            'page' => 1,
            'itemsPerPage' => $itemsPerPage,
            'priceMin' => 0,
            'priceMax' => 0
        ];

        $searchFactory = SearchItems::getSearchFactory($options);
        $searchFactory->withResultFields([
            'item.id',
            'variation.id',
            'variation.itemId',
            'variation.name',
            'variation.number',
            'variation.availability.names.name',
            'texts.lang',
            'texts.name1',
            'texts.name2',
            'texts.name3',
            'texts.shortDescription',
            'texts.metaDescription',
            'texts.description',
            'texts.urlPath',
            'images.all.url',
            'images.all.urlMiddle',
            'images.all.position',
            'images.variation.url',
            'images.variation.urlMiddle',
            'images.variation.position'
        ]);

        $results = $this->itemSearchService->getResults(['itemList' => $searchFactory]);
        $documents = $results['itemList']['documents'] ?? [];
        $items = [];

        foreach ($documents as $document)
        {
            $data = $document['data'] ?? [];
            $item = $this->mapProduct($data);

            if ($item !== null)
            {
                $items[] = $item;
            }
        }

        return ['settings' => $settings, 'items' => $items];
    }

    private function mapProduct(array $data)
    {
        $itemId = (int) $this->value($data, 'item.id', $this->value($data, 'variation.itemId', 0));
        $variationId = (int) $this->value($data, 'variation.id', 0);

        if ($itemId <= 0 || $variationId <= 0)
        {
            return null;
        }

        $title = trim((string) $this->value($data, 'texts.name1', ''));
        if ($title === '')
        {
            $title = trim((string) $this->value($data, 'variation.name', ''));
        }
        if ($title === '')
        {
            $title = 'Artikel ' . $itemId;
        }

        $description = (string) $this->value($data, 'texts.shortDescription', '');
        if (trim($description) === '')
        {
            $description = (string) $this->value($data, 'texts.metaDescription', '');
        }
        if (trim($description) === '')
        {
            $description = (string) $this->value($data, 'texts.description', '');
        }

        $variationNumber = trim((string) $this->value($data, 'variation.number', ''));
        $availability = trim((string) $this->value($data, 'variation.availability.names.name', ''));

        $displayInformation = 'Artikel-ID: ' . $itemId;
        if ($variationNumber !== '')
        {
            $displayInformation .= ' | Art.-Nr.: ' . $variationNumber;
        }
        if ($availability !== '')
        {
            $displayInformation .= ' | ' . $availability;
        }

        $product = [
            'title' => $title,
            'description' => $this->cleanDescription($description),
            'url' => $this->buildProductUrl($data, $itemId, $variationId),
            'price' => $this->getPrice($data),
            'display_info' => $displayInformation
        ];

        $image = $this->getImage($data);
        if ($image !== '')
        {
            $product['image'] = $image;
        }

        return $product;
    }

    private function cleanDescription(string $description): string
    {
        $description = html_entity_decode(strip_tags($description), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $description = trim((string) preg_replace('/\s+/u', ' ', $description));
        $maximumLength = (int) $this->config->get('CeresCoconut.cleverreach.descriptionLength', 320);
        $maximumLength = max(80, min(2000, $maximumLength));

        if (mb_strlen($description, 'UTF-8') > $maximumLength)
        {
            $description = rtrim(mb_substr($description, 0, $maximumLength - 1, 'UTF-8')) . '…';
        }

        return $description;
    }

    private function getPrice(array $data): string
    {
        $paths = [
            'prices.specialOffer.unitPrice.formatted',
            'prices.specialOffer.price.formatted',
            'prices.default.unitPrice.formatted',
            'prices.default.price.formatted'
        ];

        foreach ($paths as $path)
        {
            $price = trim((string) $this->value($data, $path, ''));
            if ($price !== '')
            {
                return $price;
            }
        }

        return '';
    }

    private function getImage(array $data): string
    {
        $images = $this->value($data, 'images.variation', []);
        if (!is_array($images) || count($images) === 0)
        {
            $images = $this->value($data, 'images.all', []);
        }

        if (!is_array($images) || count($images) === 0)
        {
            return '';
        }

        usort($images, function ($left, $right)
        {
            return ((int) ($left['position'] ?? 0)) <=> ((int) ($right['position'] ?? 0));
        });

        foreach ($images as $image)
        {
            $url = trim((string) ($image['urlMiddle'] ?? $image['url'] ?? ''));
            if ($url !== '')
            {
                return $url;
            }
        }

        return '';
    }

    private function buildProductUrl(array $data, int $itemId, int $variationId): string
    {
        $baseUrl = rtrim(
            trim((string) $this->config->get('CeresCoconut.cleverreach.baseUrl', 'https://www.amikon-shop.de')),
            '/'
        );
        $urlPath = trim((string) $this->value($data, 'texts.urlPath', ''), '/');
        $language = trim((string) $this->value($data, 'texts.lang', ''));
        $defaultLanguage = (string) Utils::getDefaultLang();
        $path = '';

        if ($language !== '' && $language !== $defaultLanguage)
        {
            $path .= '/' . rawurlencode($language);
        }

        if ($urlPath !== '')
        {
            $path .= '/' . $urlPath;
        }

        if ($this->ceresGlobalConfig->enableOldUrlPattern)
        {
            $suffix = '/a-' . $itemId;
        }
        else
        {
            $suffix = '_' . $itemId . '_' . $variationId;
        }

        if (substr($path, -strlen($suffix)) !== $suffix)
        {
            $path .= $suffix;
        }

        return $baseUrl . '/' . ltrim($path, '/');
    }

    private function value(array $data, string $path, $default = null)
    {
        $value = $data;

        foreach (explode('.', $path) as $key)
        {
            if (!is_array($value) || !array_key_exists($key, $value))
            {
                return $default;
            }

            $value = $value[$key];
        }

        return $value;
    }
}
