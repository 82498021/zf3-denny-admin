<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 03/05/2017
 * Time: 08:33
 */

namespace Main\Model;


use Main\Entity\ManagerEntity;
use Main\InterFaces\Model\ManagerModelInterFace;
use System\Helper\SecretHelper;
use System\Helper\StringHelper;
use System\Model\DaoModel;
use Zend\Db\Adapter\AdapterInterface;

use Zend\Hydrator\HydratorInterface;

class ManagerModel extends DaoModel implements ManagerModelInterFace
{


    /**
     * ManagerModel constructor.
     * @param AdapterInterface $db
     * @param HydratorInterface $hydrator
     * @param ManagerEntity $entity
     */
    public function __construct(AdapterInterface $db,
                                HydratorInterface $hydrator,
                                ManagerEntity $entity)
    {
        parent::__construct($db,$hydrator,$entity);

    }

    /**
     * @param ManagerEntity $entity
     * @return mixed
     */
    function createUser($entity)
    {
        $entity->setCreateTime(time())
            ->setUpdateTime(time())
            ->setRoles(StringHelper::arrayToString($entity->getRoles()))
            ->setPassword(12);

        $userId=self::create($entity);

        $entity->setId($userId);


     return   self::setPassword($entity);

    }

    /**
     * @param ManagerEntity $entity
     * @return mixed
     */
    function updateUser($entity)
    {
        $entity->setUpdateTime(time())
            ->setRoles(StringHelper::arrayToString($entity->getRoles()));

        return self::update($entity);
    }


    /**
     * @param ManagerEntity $entity
     * @param string $pass
     * @return mixed
     */
    function setPassword($entity, $pass=DEFAULT_USER_PASS)
    {

        if(empty($entity->getEncrypted())){
            $authCode=SecretHelper::authCode();

            $entity->setEncrypted($authCode);
        }else{
            $authCode=$entity->getEncrypted();
        }

        $password=SecretHelper::encryption($pass,$authCode);

        $entity->setPassword($password);

        return self::update($entity);

    }


}