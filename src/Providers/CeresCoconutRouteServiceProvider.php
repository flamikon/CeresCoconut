<?php

namespace CeresCoconut\Providers;

use Plenty\Plugin\RouteServiceProvider;
use Plenty\Plugin\Routing\ApiRouter;
use Plenty\Plugin\Routing\Router;

/**
 * Registers the public REST endpoint used by CleverReach MyContent.
 */
class CeresCoconutRouteServiceProvider extends RouteServiceProvider
{
    /**
     * @param Router $router
     * @param ApiRouter $api
     */
    public function map(Router $router, ApiRouter $api)
    {
        $api->version(
            ['v1'],
            ['namespace' => 'CeresCoconut\Api\Resources'],
            function (ApiRouter $api)
            {
                $api->post('cleverreach/products', 'CleverReachProductResource@store');
            }
        );
    }
}
