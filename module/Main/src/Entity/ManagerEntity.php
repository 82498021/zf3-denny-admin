<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 02/05/2017
 * Time: 14:15
 */

namespace Main\Entity;


class ManagerEntity
{

    // User status constants.
    const STATUS_ACTIVE = 1; // Active user.

    const STATUS_RETIRED = 2; // Retired user.

    private $id;

    private $username;

    private $password;

    private $encrypted;

    private $old_pass;

    private $nick_name;

    private $roles;

    private $create_time;

    private $update_time;

    private $status;



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return ManagerEntity
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param $username
     * @return ManagerEntity
     */
    public function setUsername($username)
    {
        $this->username = $username;

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
     * @return ManagerEntity
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
     * @return ManagerEntity
     */
    public function setEncrypted($encrypted)
    {
        $this->encrypted = $encrypted;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOldPass()
    {
        return $this->old_pass;
    }

    /**
     * @param $old_pass
     * @return ManagerEntity
     */
    public function setOldPass($old_pass)
    {
        $this->old_pass = $old_pass;

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
     * @return ManagerEntity
     */
    public function setNickName($nick_name)
    {
        $this->nick_name = $nick_name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param $roles
     * @return ManagerEntity
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

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
     * @return ManagerEntity
     */
    public function setCreateTime($create_time)
    {
        $this->create_time = $create_time;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdateTime()
    {
        return $this->update_time;
    }

    /**
     * @param $update_time
     * @return ManagerEntity
     */
    public function setUpdateTime($update_time)
    {
        $this->update_time = $update_time;

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
     * @return ManagerEntity
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }




}