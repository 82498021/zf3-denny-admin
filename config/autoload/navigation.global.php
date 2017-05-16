<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 17/4/11
 * Time: 08:49
 */

//use Zend\Navigation\ConfigProvider;

return [
//    'service_manager' => (new ConfigProvider())->getDependencyConfig(),

    'service_manager' => [
        'abstract_factories' => [
            Zend\Navigation\Service\NavigationAbstractServiceFactory::class,
        ],
    ],

    'navigationAdmin'=>[

    ],

    'navigation' => [
        'admin'=>[
            [
                'label' => '主页',
                'route' => 'admin/index',
            ],
            [
                'label' => '用户管理',
                'route' => 'admin/login',
            ],
            [
                'label' => 'out',
                'route' => 'admin/out',
            ]
        ],
        'default' => [
            [
                'label' => 'Home',
                'route' => 'home/index',
            ],

            [
                'label' => 'blog',
                'route' => 'admin/blog',
            ],
        ]
    ],

];