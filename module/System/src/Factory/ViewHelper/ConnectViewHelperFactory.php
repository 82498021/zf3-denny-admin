<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 05/05/2017
 * Time: 23:26
 */

namespace System\Factory\ViewHelper;


use Interop\Container\ContainerInterface;
use System\ViewHelper\ConnectViewHelper;
use Zend\ServiceManager\Factory\FactoryInterface;
use Main\InterFaces\Model\ResourcesModelInterFace;

class ConnectViewHelperFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /**
         * @var \Zend\Mvc\Application $application
         */
        $application=$container->get("Application");

        return new ConnectViewHelper($container->get(ResourcesModelInterFace::class),$application->getMvcEvent());
    }


}