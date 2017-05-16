<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 03/05/2017
 * Time: 09:02
 */

namespace Main\InterFaces\Model;


use System\Model\DaoInterFace;

interface ManagerModelInterFace extends DaoInterFace
{


    /**
     * 新增新的用户
     * @param $entity
     * @return mixed
     */
    function createUser($entity);

    /**
     * 设置用户密码
     * @param $entity
     * @param $password
     * @return mixed
     */
    function setPassword($entity,$password);


    /**
     * 修改客户信息
     * @param $entity
     * @return mixed
     */
    function updateUser($entity);




}