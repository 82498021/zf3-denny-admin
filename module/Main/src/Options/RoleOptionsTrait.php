<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 2017/5/9
 * Time: 11:15
 */

namespace Main\Options;

use Main\Options\RoleOptions;


trait RoleOptionsTrait
{

    private $roleOptions;


    public function getRoles()
    {
        return $this->roleOptions;
    }

    public function setRoles(RoleOptions $roles)
    {
        $this->roleOptions = $roles;

        return $this;
    }

}