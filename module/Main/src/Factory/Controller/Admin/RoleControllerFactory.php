<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 05/05/2017
 * Time: 09:08
 */

namespace Main\Factory\Controller\Admin;


use Interop\Container\ContainerInterface;
use Main\Controller\Admin\RoleController;
use Main\Form\RoleForm;
use Main\InterFaces\Model\RoleModelInterFace;
use Main\InterFaces\Model\ResourcesModelInterFace;
use Zend\ServiceManager\Factory\FactoryInterface;

class RoleControllerFactory implements FactoryInterface
{


    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $formManager = $container->get('FormElementManager');


       return new RoleController($container->get(RoleModelInterFace::class),$formManager->get(RoleForm::class),$container->get(ResourcesModelInterFace::class));
    }


}