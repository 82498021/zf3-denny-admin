<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 2017/4/28
 * Time: 15:10
 */

namespace Home;




use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ServiceManager\Factory\InvokableFactory;
use Main\Factory\Service\AuthenticationServiceFactory;
use Zend\Authentication\AuthenticationService;


class Module implements ConfigProviderInterface,
    ControllerProviderInterface,
    ServiceProviderInterface
{

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }




    public function getServiceConfig(){

        return [
            'aliases'=>[
            ],
            'factories'=>[
            ]
        ];

    }



    function getControllerConfig(){

        return [
            'factories'=>[
                Controller\Home\IndexController::class => InvokableFactory::class,
                Controller\Admin\IndexController::class=>InvokableFactory::class,
            ]
        ];

    }


}