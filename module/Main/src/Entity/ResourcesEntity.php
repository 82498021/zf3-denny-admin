<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 04/05/2017
 * Time: 16:06
 */

namespace Main\Entity;


class ResourcesEntity
{
    private $id;

    private $title;

    private $router;

    private $parent_id;

    private $module;

    private $controller;

    private $action;

    private $ico;

    private $class;

    private $status;

    private $sort;

    private $category;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return ResourcesEntity
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
     * @return ResourcesEntity
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * @param $router
     * @return ResourcesEntity
     */
    public function setRouter($router)
    {
        $this->router = $router;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * @param $parent_id
     * @return ResourcesEntity
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIco()
    {
        return $this->ico;
    }

    /**
     * @param $ico
     * @return ResourcesEntity
     */
    public function setIco($ico)
    {
        $this->ico = $ico;

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
     * @return ResourcesEntity
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param $class
     * @return ResourcesEntity
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }



    /**
     * @return mixed
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param $sort
     * @return ResourcesEntity
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param $category
     * @return ResourcesEntity
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @param $module
     * @return ResourcesEntity
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param $controller
     * @return ResourcesEntity
     */
    public function setController($controller)
    {
        $this->controller = $controller;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param $action
     * @return ResourcesEntity
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }




}