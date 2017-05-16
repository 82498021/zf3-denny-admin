<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 2017/5/9
 * Time: 10:55
 */

namespace Main\Options;


interface RoleOptionsAwareInterface
{

    public function getRoles();

    public function setRoles(RoleOptions $roles);

}