<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 2017/5/15
 * Time: 14:13
 */

namespace Main\Form\Entity;


use Main\Entity\MemberEntity;

class MemberFormEntity extends MemberEntity
{
    //额外字段,重复密码,不计入table中
    private $pass;

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param $pass
     * @return $this
     */
    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }


}