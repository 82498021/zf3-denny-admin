<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 2017/4/28
 * Time: 15:10
 */

namespace Home;



use Home\Controller\Admin\IndexController as AdminController;
use Home\Controller\Home\IndexController as HomeController;
use Zend\Router\Http\Hostname;
use Zend\Router\Http\Literal;

return [


    'router' => [
        'routes' => [
            /**
             * 后台管理模块
             */
            'admin' => [
                'type' => Hostname::class,
                "options" => [
                    'route' => HTTP_ADMIN_URL,
                ],
                'may_terminate' => true,
                'child_routes' => [
                    //默认首页
                    'index' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/',
                            'defaults' => [
                                'controller' => AdminController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],


                ],
            ],

            /**
             * 前台模块
             */
            'home' => [
                'type' => Hostname::class,
                "options" => [
                    'route' => HTTP_HOME_URL,
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'index' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/',
                            'defaults' => [
                                'controller' =>HomeController::class,
                                'action' => 'index',
                            ],
                        ],
                    ]
                ],
            ],
        ],
    ],



    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];