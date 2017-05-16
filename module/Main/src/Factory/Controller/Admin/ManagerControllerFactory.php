<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 05/05/2017
 * Time: 09:08
 */

namespace Main\Factory\Controller\Admin;


use Interop\Container\ContainerInterface;
use Main\Controller\Admin\ManagerController;
use Main\Form\ManagerForm;
use Main\InterFaces\Model\ManagerModelInterFace;
use Zend\ServiceManager\Factory\FactoryInterface;


class ManagerControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $formManager = $container->get('FormElementManager');

       return new ManagerController($container->get(ManagerModelInterFace::class),$formManager->get(ManagerForm::class));
    }




}