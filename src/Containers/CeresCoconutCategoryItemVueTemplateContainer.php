<?php 

namespace CeresCoconut\Containers;

use Plenty\Plugin\Templates\Twig;

class CeresCoconutCategoryItemVueTemplateContainer
{
    public function call(Twig $twig):string
    {
        return $twig->render('CeresCoconut::ItemList.Components.CategoryItem');
    }
}
