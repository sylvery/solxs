<?php
// src/Menu/MenuBuilder.php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\Security\Core\Security;

class MenuBuilder
{
    private $factory, $security;

    /**
     * Add any other dependency you need...
     */
    public function __construct(FactoryInterface $factory, Security $security)
    {
        $this->factory = $factory;
        $this->security = $security;
    }

    public function createMainMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttributes(['class' => 'navbar-nav justify-content-center mr-auto mt-2 mt-lg-0']);
        $menu->addChild('Home', [
            'route'=>'home',
            'attributes' => [
                'class' => 'nav-item nav'
            ],
            'childrenAttributes' => [
                'class' => 'nav-item'
            ],
            'linkAttributes' => [
                'class' => 'nav-link'
            ],
        ]);
        // $plantAssets = $menu->addChild('Customers', [
        //     'attributes' => [
        //         'class' => 'dropdown',
        //     ],
        //     'childrenAttributes' => [
        //         'class' => 'dropdown-menu bg-light mt-0',
        //     ],
        //     'labelAttributes' => [
        //         'class' => 'btn btn-default nav-link dropdown-toggle',
        //         // 'style' => 'font-size: 1rem !important;',
        //         'type' => 'button',
        //         'id' => 'plantAssetMenuDropdownTriggerId',
        //         'data-toggle' => 'dropdown',
        //         'aria-haspopup' => 'true',
        //     ]
        // ]);
        // $plantAssets
        //     ->addChild('List of Plant Assets', [
        //         'route'=>'home',
        //         'attributes' => ['class' => 'nav-item'],
        //         'linkAttributes' => ['class' => 'nav-link'],
        //     ])
        //     ->addChild('Add new plant assets', [
        //         'route'=>'home',
        //         'attributes' => ['class' => 'nav-item'],
        //         'linkAttributes' => ['class' => 'nav-link small'],
        //     ])
        // ;
        $menu->addChild('Customer', [
            'route' => 'customer_index',
            'attributes' => ['class'=>'nav-item text-center'],
            'linkAttributes' => ['class'=>'nav-link']
        ]);
        $menu->addChild('Orders', [
            'route' => 'customer_order_index',
            'attributes' => ['class'=>'nav-item text-center'],
            'linkAttributes' => ['class'=>'nav-link']
        ]);
        $menu->addChild('Designs', [
            'route' => 'design_index',
            'attributes' => ['class'=>'nav-item text-center'],
            'linkAttributes' => ['class'=>'nav-link']
        ]);
        $menu->addChild('Category', [
            'route' => 'design_category_index',
            'attributes' => ['class'=>'nav-item text-center'],
            'linkAttributes' => ['class'=>'nav-link']
        ]);
        return $menu;
    }
}
