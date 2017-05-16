<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 01/05/2017
 * Time: 15:20
 */

namespace System;


use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;
use Zend\Mvc\MvcEvent;
use System\Authentication\Check\ManagerCheck;

class Module implements ServiceProviderInterface,
    ViewHelperProviderInterface
{


    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }


    public function getServiceConfig(){

        return [
            'aliases'=>[

            ]
        ];

    }


    public function getViewHelperConfig(){

        return [
            'aliases'=>[
                'adminMenuPlug' => ViewHelper\AdminMenuViewHelper::class,
                'connectHelper'=>ViewHelper\ConnectViewHelper::class
            ],
            'factories'=>[
                ViewHelper\AdminMenuViewHelper::class=>Factory\ViewHelper\AdminMenuViewFactory::class,
                ViewHelper\ConnectViewHelper::class=>Factory\ViewHelper\ConnectViewHelperFactory::class
            ]
        ];

    }



    public function onBootstrap(MvcEvent $e)
    {

        $eventManager = $e->getApplication()->getEventManager();

        $container = $e->getApplication()->getServiceManager();

        $eventManager->attach(MvcEvent::EVENT_DISPATCH, [ManagerCheck::class, 'isCheck'], 100);

        $eventManager->attach(MvcEvent::EVENT_ROUTE,[Service\GlobalAdapterListener::class,'setAdapter'],-99);
    }


//    public function onBootstrap(MvcEvent $e){
//
//        $eventManager = $e->getApplication()->getEventManager();
//
//        $container    = $e->getApplication()->getServiceManager();
//
//        $eventManager->attach(MvcEvent::EVENT_DISPATCH,[Check::class,'isCheck'],100);
//
//        $eventManager->attach(MvcEvent::EVENT_DISPATCH,function (MvcEvent $e) use ($container) {
//            /**
//             * @var \Zend\Router\Http\RouteMatch $match
//             */
//            $match       = $e->getRouteMatch();
//            /**
//             * @var \Zend\Authentication\AuthenticationService $authService
//             */
//            $authService = $container->get("AuthService");
//
//            $routeName   = $match->getMatchedRouteName();
//
//            if ($authService->hasIdentity()){
//                echo "true";
//            }else{
//                echo "false";
//            }
//        });

//    }



}