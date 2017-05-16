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
use System\Authentication\Adapter\CredentialTreatmentAdapter;
use Zend\ServiceManager\Factory\FactoryInterface;

class UserAuthenticationServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        $auth=new AuthenticationService();

        $adapter=new CredentialTreatmentAdapter($container->get(AdapterInterface::class),'member','mail','password');

        $auth->setStorage(new AuthStorage("user_key",'user'));

        $auth->setAdapter($adapter);



        return $auth;
    }


}