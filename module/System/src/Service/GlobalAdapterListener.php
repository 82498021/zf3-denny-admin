<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 2017/5/15
 * Time: 13:17
 */

namespace System\Service;


use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\Feature\GlobalAdapterFeature;
use Zend\Mvc\MvcEvent;

class GlobalAdapterListener
{

    public static function setAdapter(MvcEvent $event)
    {
        /**
         * @var \Zend\Authentication\AuthenticationService $authService
         */
        $container = $event->getApplication()->getServiceManager();

        $adapter = $container->get(AdapterInterface::class);

        GlobalAdapterFeature::setStaticAdapter($adapter);

    }


}