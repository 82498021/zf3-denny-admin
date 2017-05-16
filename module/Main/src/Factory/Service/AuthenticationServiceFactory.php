<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 03/05/2017
 * Time: 14:50
 */

namespace Main\Factory\Service;

use Interop\Container\ContainerInterface;

use System\Authentication\Storage\AuthStorage;
use Zend\Authentication\AuthenticationService;
use Zend\Db\Adapter\AdapterInterface;
//use Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter;
use System\Authentication\Adapter\CredentialTreatmentAdapter;
use Zend\ServiceManager\Factory\FactoryInterface;

class AuthenticationServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        $auth=new AuthenticationService();

        $adapter=new CredentialTreatmentAdapter($container->get(AdapterInterface::class),'manager','username','password');

        $auth->setStorage(new AuthStorage("admin_manager",'manager'));

        $auth->setAdapter($adapter);



        return $auth;
    }


}