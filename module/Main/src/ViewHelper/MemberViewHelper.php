<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 2017/5/15
 * Time: 17:17
 */

namespace Main\ViewHelper;


use Main\InterFaces\Model\MemberModelInterFace;
use Zend\View\Helper\AbstractHelper;

class MemberViewHelper extends AbstractHelper
{
    /**
     * @var MemberModelInterFace
     */
    private $memberModel;

    function __construct(MemberModelInterFace $memberModel)
    {
        $this->memberModel = $memberModel;
    }


    function getUser($id)
    {
        return $this->memberModel->findById($id);


    }


}