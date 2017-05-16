<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 03/05/2017
 * Time: 09:02
 */

namespace Main\InterFaces\Model;


use System\Model\DaoInterFace;

interface MemberModelInterFace extends DaoInterFace
{


    function createUser($entity);



}