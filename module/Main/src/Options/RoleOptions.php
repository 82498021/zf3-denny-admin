<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 2017/5/9
 * Time: 10:29
 */

namespace Main\Options;


class RoleOptions
{

    function __construct($data)
    {
        $this->setRoles($data);
    }


    private $roles;

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }







}