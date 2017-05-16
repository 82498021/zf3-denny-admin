<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 02/05/2017
 * Time: 14:27
 */

namespace Main\Factory\Controller\Admin;


use Interop\Container\ContainerInterface;
use Main\Controller\Admin\LoginController;
use Main\Form\LoginForm;
use Zend\ServiceManager\Factory\FactoryInterface;
use Main\InterFaces\Model\ManagerModelInterFace;


class LoginControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $formManager = $container->get('FormElementManager');

        $authService=$container->get("AuthService");

        return new LoginController($container->get(ManagerModelInterFace::class),
            $formManager->get(LoginForm::class),
            $authService,
            $authService->getStorage()
        );
    }




}