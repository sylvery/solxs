<?php

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

    public function createShortcutMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttributes(['class' => 'navbar-nav justify-content-center mr-auto mt-2 mt-lg-0']);
        // $menu->addChild('Shortcuts', [
        //     'route'=>'home',
        //     'attributes' => [
        //         'class' => 'nav-item nav'
        //     ],
        //     'childrenAttributes' => [
        //         'class' => 'nav-item'
        //     ],
        //     'linkAttributes' => [
        //         'class' => 'nav-link'
        //     ],
        // ]);
        $shortcuts = $menu->addChild('Shortcuts', [
            'attributes' => [
                'class' => 'dropdown float-right',
            ],
            'childrenAttributes' => [
                'class' => 'dropdown-menu bg-light mt-0',
            ],
            'labelAttributes' => [
                'class' => 'btn btn-default nav-link dropdown-toggle',
                // 'style' => 'font-size: 1rem !important;',
                'type' => 'button',
                'id' => 'ordersDropdown',
                'data-toggle' => 'dropdown',
                'aria-haspopup' => 'true',
            ]
        ]);
        $shortcuts->addChild('Add new Order', [
            'route'=>'customer_order_new',
            'attributes' => ['class' => 'nav-item'],
            'linkAttributes' => ['class' => 'nav-link'],
        ]);

        $shortcuts->addChild('Add new Customer', [
            'route'=>'customer_new',
            'attributes' => ['class' => 'nav-item'],
            'linkAttributes' => ['class' => 'nav-link'],
        ]);

        $shortcuts->addChild('Add new Design', [
            'route'=>'design_new',
            'attributes' => ['class' => 'nav-item'],
            'linkAttributes' => ['class' => 'nav-link'],
        ]);
        return $menu;
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
        $menu->addChild('Orders', [
            'route'=>'customer_order_index',
            'attributes' => ['class' => 'nav-item'],
            'linkAttributes' => ['class' => 'nav-link'],
        ]);
        // $customers = $menu->addChild('Customers', [
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
        //         'id' => 'customersDropdown',
        //         'data-toggle' => 'dropdown',
        //         'aria-haspopup' => 'true',
        //     ]
        // ]);
        $menu->addChild('Customers', [
            'route'=>'customer_index',
            'attributes' => ['class' => 'nav-item'],
            'linkAttributes' => ['class' => 'nav-link'],
        ]);
        $menu->addChild('React', [
            'route'=>'app_react_default',
            'attributes' => ['class' => 'nav-item'],
            'linkAttributes' => ['class' => 'nav-link'],
        ]);
        // $designs = $menu->addChild('Designs', [
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
        //         'id' => 'designsDropdown',
        //         'data-toggle' => 'dropdown',
        //         'aria-haspopup' => 'true',
        //     ]
        // ]);
        $menu->addChild('Designs', [
            'route'=>'design_index',
            'attributes' => ['class' => 'nav-item'],
            'linkAttributes' => ['class' => 'nav-link'],
        ]);
        // $designs->addChild('Categories', [
        //     'route' => 'design_category_index',
        //     'attributes' => ['class'=>'nav-item text-center'],
        //     'linkAttributes' => ['class'=>'nav-link']
        // ]);
        return $menu;
    }
}
