<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 2017/5/14
 * Time: 13:43
 */

namespace Main\Factory\Controller\User;


use Interop\Container\ContainerInterface;
use Main\Controller\User\RegisterController;
use Main\Form\MemberLoginForm;
use Zend\ServiceManager\Factory\FactoryInterface;
use Main\InterFaces\Model\MemberModelInterFace;

class RegisterControllerFactory implements  FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $authService=$container->get("UserAuthService");

        $formManager = $container->get('FormElementManager');

        return new RegisterController($container->get(MemberModelInterFace::class),$authService,$authService->getStorage(""),$formManager->get(MemberLoginForm::class));

    }


}
