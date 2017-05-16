<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 2017/5/8
 * Time: 08:54
 */

namespace Main\Entity;


class RoleEntity
{

    private $id;

    private $title;

    private $rack;

    private $status;

    private $access;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return RoleEntity
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $title
     * @return RoleEntity
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRack()
    {
        return $this->rack;
    }

    /**
     * @param $rack
     * @return RoleEntity
     */
    public function setRack($rack)
    {
        $this->rack = $rack;

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
     * @return RoleEntity
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * @param $access
     * @return RoleEntity
     */
    public function setAccess($access)
    {
        $this->access = $access;

        return $this;
    }




}