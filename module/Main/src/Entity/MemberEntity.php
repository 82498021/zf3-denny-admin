<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 2017/5/14
 * Time: 13:28
 */

namespace Main\Entity;


class MemberEntity
{

    protected $id;

    protected $mail;

    protected $password;

    protected $encrypted;

    protected $nick_name;

    protected $create_time;

    protected $last_time;

    protected $status;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return MemberEntity
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param $mail
     * @return MemberEntity
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     * @return MemberEntity
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEncrypted()
    {
        return $this->encrypted;
    }

    /**
     * @param $encrypted
     * @return MemberEntity
     */
    public function setEncrypted($encrypted)
    {
        $this->encrypted = $encrypted;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreateTime()
    {
        return $this->create_time;
    }

    /**
     * @param $create_time
     * @return MemberEntity
     */
    public function setCreateTime($create_time)
    {
        $this->create_time = $create_time;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastTime()
    {
        return $this->last_time;
    }

    /**
     * @param $last_time
     * @return MemberEntity
     */
    public function setLastTime($last_time)
    {
        $this->last_time = $last_time;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param $status
     * @return MemberEntity
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNickName()
    {
        return $this->nick_name;
    }

    /**
     * @param $nick_name
     * @return $this
     */
    public function setNickName($nick_name)
    {
        $this->nick_name = $nick_name;

        return $this;
    }




}