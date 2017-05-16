<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 05/05/2017
 * Time: 09:08
 */

namespace Main\Factory\Controller\Admin;


use Interop\Container\ContainerInterface;
use Main\Controller\Admin\ResourceController;
use Zend\ServiceManager\Factory\FactoryInterface;
use Main\InterFaces\Model\ResourcesModelInterFace;
use Main\Form\ResourceForm;

class ResourceControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $formManager = $container->get('FormElementManager');

       return new ResourceController($container->get(ResourcesModelInterFace::class),$formManager->get(ResourceForm::class));
    }




}