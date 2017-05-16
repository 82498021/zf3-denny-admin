<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 2017/5/14
 * Time: 13:31
 */

namespace Main\Model;


use Main\Entity\MemberEntity;
use Main\InterFaces\Model\MemberModelInterFace;
use System\Helper\SecretHelper;
use System\Model\DaoModel;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Hydrator\HydratorInterface;

class MemberModel extends DaoModel implements MemberModelInterFace
{


    /**
     * MemberModel constructor.
     * @param AdapterInterface $db
     * @param HydratorInterface $hydrator
     * @param MemberEntity $entity
     */
    public function __construct(AdapterInterface $db,
                                HydratorInterface $hydrator,
                                MemberEntity $entity)
    {
        parent::__construct($db,$hydrator,$entity);

    }


    /**
     * @param MemberEntity $entity
     * @return mixed
     */
    function createUser($entity)
    {
        $memberEntity=new MemberEntity();

        $memberEntity->setId(md5(SecretHelper::authCode()))
            ->setCreateTime(time())
            ->setNickName($entity->getNickName())
            ->setStatus(false)
            ->setLastTime(time())
            ->setMail($entity->getMail())
            ->setPassword($entity->getPassword());

       self::create($memberEntity);

        return   self::setPassword($memberEntity,$memberEntity->getPassword());

    }


    /**
     * @param MemberEntity $entity
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