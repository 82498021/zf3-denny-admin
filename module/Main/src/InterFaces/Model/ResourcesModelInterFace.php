<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 04/05/2017
 * Time: 16:04
 */

namespace Main\InterFaces\Model;


use System\Model\DaoInterFace;

interface ResourcesModelInterFace extends DaoInterFace
{
    /**
     * 根据子类获取相关信息
     * @param $id
     * @param array $arr
     * @param int $pid
     * @return mixed
     */
    public function getCascade($id,$arr=[],$pid=0);


    /**
     * @param $category
     * @return array
     */
    public function multiResources($category);

    /**
     * @param $data
     * @param $pid
     * @return mixed
     */
    public function combination($data, $pid);

}