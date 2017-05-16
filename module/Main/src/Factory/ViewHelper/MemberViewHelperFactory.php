<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 2017/5/15
 * Time: 17:20
 */

namespace Main\Factory\ViewHelper;


use Interop\Container\ContainerInterface;
use Main\InterFaces\Model\MemberModelInterFace;
use Main\ViewHelper\MemberViewHelper;
use Zend\ServiceManager\Factory\FactoryInterface;

class MemberViewHelperFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

      return  new MemberViewHelper($container->get(MemberModelInterFace::class));
    }


}