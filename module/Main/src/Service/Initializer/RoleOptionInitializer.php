<?php
/**
 * Created by PhpStorm.
 * User: Denny
 * Date: 15/4/21
 * Time: 16:52
 */

namespace Main\Service\Initializer;

use Interop\Container\ContainerInterface;
use Main\Options\RoleOptionsAwareInterface;
use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RoleOptionInitializer implements InitializerInterface{

    public function initialize($instance, ServiceLocatorInterface $serviceLocator){


    }

    public function __invoke(ContainerInterface $container, $instance)
    {
       if($instance instanceof RoleOptionsAwareInterface){
           $options=$container->get("RoleOptions");

           $instance->setRoles($options);
       }
    }


}