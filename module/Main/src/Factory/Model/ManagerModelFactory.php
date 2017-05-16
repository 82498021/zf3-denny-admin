<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 03/05/2017
 * Time: 08:39
 */

namespace Main\Factory\Model;


use Interop\Container\ContainerInterface;
use Main\Entity\ManagerEntity;
use Main\Model\ManagerModel;
use Zend\Db\Adapter\AdapterInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Hydrator\Reflection as ReflectionHydrator;

class ManagerModelFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        return new ManagerModel($container->get(AdapterInterface::class),new ReflectionHydrator(),new ManagerEntity());
    }


}