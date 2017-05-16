<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 2017/5/8
 * Time: 08:58
 */

namespace Main\Model;


use Main\Entity\RoleEntity;
use Main\InterFaces\Model\RoleModelInterFace;
use System\Helper\StringHelper;
use System\Model\DaoModel;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Hydrator\HydratorInterface;

class RoleModel extends DaoModel implements RoleModelInterFace
{


    /**
     * RoleModel constructor.
     * @param AdapterInterface $db
     * @param HydratorInterface $hydrator
     * @param RoleEntity $entity
     */
    public function __construct(AdapterInterface $db,
                                HydratorInterface $hydrator,
                                RoleEntity $entity)
    {
        parent::__construct($db,$hydrator,$entity);

    }


    /**
     * @param $obj
     * @return mixed
     */
    public function saveAccess($obj)
    {
        /**
         * @var \Main\Entity\RoleEntity $entity
         */
       $entity= self::findById($obj->id);


        $entity=$entity->setAccess(StringHelper::arrayToString($obj->ids));

       return self::update($entity);

    }

}