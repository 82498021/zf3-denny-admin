<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 2017/4/28
 * Time: 15:10
 */

namespace Main;




use Main\Factory\Service\UserAuthenticationServiceFactory;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\FormElementProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Main\Factory\Service\AuthenticationServiceFactory;
use Zend\Authentication\AuthenticationService;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;


class Module implements ConfigProviderInterface,
    ControllerProviderInterface,
    ServiceProviderInterface,
    FormElementProviderInterface,
    ViewHelperProviderInterface
{

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }


    public function getViewHelperConfig(){

        return [
            'aliases'=>[
                'memberViewPlug' => ViewHelper\MemberViewHelper::class
            ],
            'factories'=>[
                ViewHelper\MemberViewHelper::class=>Factory\ViewHelper\MemberViewHelperFactory::class
            ]
        ];

    }




    public function getServiceConfig(){

        return [
            'aliases'=>[
                InterFaces\Model\ManagerModelInterFace::class=>Model\ManagerModel::class,
                AuthenticationService::class => "AuthService",
                AuthenticationService::class => "UserAuthService",
                InterFaces\Model\ResourcesModelInterFace::class=>Model\ResourcesModel::class,
                InterFaces\Model\RoleModelInterFace::class=>Model\RoleModel::class,
                InterFaces\Model\MemberModelInterFace::class=>Model\MemberModel::class,
            ],
            'factories'=>[
                Model\ManagerModel::class=>Factory\Model\ManagerModelFactory::class,
                "AuthService" => AuthenticationServiceFactory::class,
                "UserAuthService" => UserAuthenticationServiceFactory::class,
                Model\ResourcesModel::class=>Factory\Model\ResourcesModelFactory::class,
                Model\RoleModel::class=>Factory\Model\RoleModelFactory::class,
                Model\MemberModel::class=>Factory\Model\MemberModelFactory::class,
                "RoleOptions"=>Factory\Service\RoleOptionsFactory::class
            ]
        ];

    }

    public function getFormElementConfig(){

        return [
            'initializers'=>[
                Service\Initializer\RoleOptionInitializer::class
            ]
        ];
    }



    function getControllerConfig(){

        return [
            'factories'=>[
                Controller\Admin\LoginController::class=>Factory\Controller\Admin\LoginControllerFactory::class,
                Controller\Admin\ResourceController::class=>Factory\Controller\Admin\ResourceControllerFactory::class,
                Controller\Admin\RoleController::class=>Factory\Controller\Admin\RoleControllerFactory::class,
                Controller\Admin\ManagerController::class=>Factory\Controller\Admin\ManagerControllerFactory::class,
                Controller\User\LoginController::class=>Factory\Controller\User\LoginControllerFactory::class,
                Controller\User\RegisterController::class=>Factory\Controller\User\RegisterControllerFactory::class,
                Controller\User\CenterController::class=>Factory\Controller\User\CenterControllerFactory::class,
            ]
        ];

    }




}