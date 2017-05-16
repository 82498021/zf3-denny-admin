<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 03/05/2017
 * Time: 08:39
 */

namespace Main\Factory\Model;


use Interop\Container\ContainerInterface;
use Main\Entity\MemberEntity;
use Main\Model\MemberModel;
use Zend\Db\Adapter\AdapterInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Hydrator\Reflection as ReflectionHydrator;

class MemberModelFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        return new MemberModel($container->get(AdapterInterface::class),new ReflectionHydrator(),new MemberEntity());
    }


}