<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 04/05/2017
 * Time: 16:10
 */

namespace Main\Factory\Model;


use Interop\Container\ContainerInterface;
use Main\Entity\ResourcesEntity;
use Main\Model\ResourcesModel;
use Zend\Db\Adapter\AdapterInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Hydrator\Reflection as ReflectionHydrator;

class ResourcesModelFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new ResourcesModel($container->get(AdapterInterface::class),new ReflectionHydrator(),new ResourcesEntity());
    }


}