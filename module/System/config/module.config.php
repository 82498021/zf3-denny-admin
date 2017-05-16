<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 01/05/2017
 * Time: 15:20
 */

namespace System;


return [


    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'layout/home' => __DIR__ . '/../view/layout/home.phtml',
            'layout/user' => __DIR__ . '/../view/layout/user.phtml',
            'layout/empty' => __DIR__ . '/../view/layout/empty.phtml',
            'layout/admin' => __DIR__ . '/../view/layout/admin.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ],

        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],


    'view_helper_config'=>[
        'flashmessenger'=>[
            'message_open_format'=>'<div%s>',
            'message_separator_string'=>'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div%s>',
            'message_close_string'=>'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        ]
    ]

];