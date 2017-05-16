<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 2017/5/8
 * Time: 08:57
 */

namespace Main\InterFaces\Model;


use System\Model\DaoInterFace;

interface RoleModelInterFace extends DaoInterFace
{
    /**
     * 设置权限
     * @param $obj
     * @return mixed
     */
    public function saveAccess($obj);


}