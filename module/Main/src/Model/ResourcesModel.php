<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 04/05/2017
 * Time: 16:03
 */

namespace Main\Model;


use Main\Entity\ResourcesEntity;
use Main\InterFaces\Model\ResourcesModelInterFace;
use System\Model\DaoModel;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Hydrator\HydratorInterface;

class ResourcesModel extends DaoModel implements ResourcesModelInterFace
{

    /**
     * ResourcesModel constructor.
     * @param AdapterInterface $db
     * @param HydratorInterface $hydrator
     * @param ResourcesEntity $entity
     */
    public function __construct(AdapterInterface $db,
                                HydratorInterface $hydrator,
                                ResourcesEntity $entity)
    {
        parent::__construct($db,$hydrator,$entity);

    }

    /**
     * 获取多维数组
     * @param $category
     * @return array|\Zend\Db\ResultSet\HydratingResultSet
     */
    public function multiResources($category="admin")
    {
       $list= $this->selectAll(['where'=>['status'=>1,'category'=>$category]]);

        $list=$list->toArray();

        $list=$this->combination($list,0);

        return $list;
    }


    /**
     * @param $data
     * @param $pid
     * @return array
     */
    public function combination($data, $pid)
    {
        $array = [];

        foreach ($data as $key => $val) {

            if ($val['parent_id'] == $pid) {

                $array[$key] = $val;

                $array[$key]['parents'] = $this->combination($data, $val['id']);

            }
        }

        return $array;
    }



    /**
     * 获取相关父类信息
     * @param $id
     * @param array $arr
     * @param int $parentId
     * @return array|mixed
     */
    public function getCascade($id,$arr=[],$parentId=0){

        $accessData= $this->selectOne(['id'=>$id,'status'=>1],false);

        if($accessData==null)
            return [];

        $arr[$parentId]=$accessData;

        if($accessData['parent_id']!=0 && $accessData['parent_id']!=null){

            $arr=$this->getCascade($accessData['parent_id'],$arr,$parentId+1);

        }

        return $arr;
    }






}