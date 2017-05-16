<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 04/05/2017
 * Time: 16:15
 */

namespace System\Factory\ViewHelper;


use Interop\Container\ContainerInterface;
use System\ViewHelper\AdminMenuViewHelper;
use Zend\ServiceManager\Factory\FactoryInterface;
use Main\InterFaces\Model\ResourcesModelInterFace;

class AdminMenuViewFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /**
         * @var \Zend\Mvc\Application $application
         */
        $application=$container->get("Application");

        return new AdminMenuViewHelper($container->get(ResourcesModelInterFace::class),$application->getMvcEvent());
    }


}