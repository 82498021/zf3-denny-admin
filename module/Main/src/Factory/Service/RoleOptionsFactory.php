<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 2017/5/9
 * Time: 10:56
 */

namespace Main\Factory\Service;


use Interop\Container\ContainerInterface;
use Main\Options\RoleOptions;
use Zend\ServiceManager\Factory\FactoryInterface;
use Main\InterFaces\Model\RoleModelInterFace;

class RoleOptionsFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /**
         * @var \Main\InterFaces\Model\RoleModelInterFace $roleModel
         */
        $roleModel=$container->get(RoleModelInterFace::class);

        $list=$roleModel->selectAll(['where'=>['status'=>1],'order'=>['id'=>'desc']]);

        $arr=[];

        foreach($list as $val){
            $arr[$val->getId()]=$val->getTitle();
        }

       return new RoleOptions($arr);
    }


}