<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 2017/4/28
 * Time: 15:10
 */

namespace Main;


use Main\Controller\Admin\LoginController;
use Main\Controller\Admin\ManagerController;
use Main\Controller\Admin\ResourceController;
use Main\Controller\Admin\RoleController;
use Main\Controller\User\CenterController;
use Zend\Router\Http\Hostname;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Method;
use Zend\Router\Http\Segment;

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
                    //登录后台
                    'login' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/login',
                            'defaults' => [
                                'controller' => LoginController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    //登录后台
                    'out' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/out',
                            'defaults' => [
                                'controller' => LoginController::class,
                                'action' => 'out',
                            ],
                        ],
                    ],

                    //资源管理
                    'resources' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/resource[/:action[/:id]]',
                            'constraints' => [
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]+',
                            ],
                            'defaults' => [
                                'controller' => ResourceController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    //角色管理
                    'role' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/role[/:action[/:id]]',
                            'defaults' => [
                                'controller' => RoleController::class,
                                'action' => 'index',
                            ],
                            'constraints' => [
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]+',
                            ],
                        ],
                    ],

                    //管理员管理
                    'manager' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/adminUser[/:action[/:id]]',
                            'defaults' => [
                                'controller' => ManagerController::class,
                                'action' => 'index',
                            ],
                            'constraints' => [
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]+',
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


                ],
            ],


            /**
             * 会员模块
             */
            'user' => [
                'type' => Hostname::class,
                "options" => [
                    'route' => HTTP_USER_URL,
                ],
                'may_terminate' => true,
                'child_routes' => [
                    //会员管理管理
                    'user' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/user.html',
                            'defaults' => [
                                'controller' => CenterController::class,
                                'action' => 'index',
                            ]
                        ],
                    ],

                    //登录后台
                    'login' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/login',
                            'defaults' => [
                                'controller' => Controller\User\LoginController::class,
                            ],
                        ],
                        'may_terminate' => false,
                        'child_routes' => [
                            'post' => [
                                'type' => Method::class,
                                'options' => [
                                    'verb' => 'POST',
                                    'defaults' => [
                                        'action' => 'login'
                                    ]
                                ]
                            ],
                            'get' => [
                                'type' => Method::class,
                                'options' => [
                                    'verb' => 'GET',
                                    'defaults' => [
                                        'action' => 'out'
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'register' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/register',
                            'defaults' => [
                                'controller' => Controller\User\RegisterController::class,
                            ],
                        ],
                        'may_terminate' => false,
                        'child_routes' => [
                            'register' => [
                                'type' => Method::class,
                                'options' => [
                                    'verb' => 'POST',
                                    'defaults' => [
                                        'action' => 'index'
                                    ]
                                ]
                            ]
                        ]
                    ],


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