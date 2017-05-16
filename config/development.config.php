<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */


define("HTTP_ADMIN_URL",'admin.zf3.me');
define("HTTP_HOME_URL",'www.zf3.me');
define("HTTP_USER_URL",'www.zf3.me');
define("PAGING_DATA_NUM",10);
define("DEFAULT_USER_PASS","admin");

return [
    // Additional modules to include when in development mode
    'modules' => [
    ],
    // Configuration overrides during development mode
    'module_listener_options' => [
        'config_glob_paths' => [realpath(__DIR__) . '/autoload/{,*.}{global,local}-development.php'],
        'config_cache_enabled' => false,
        'module_map_cache_enabled' => false,
    ],
];
