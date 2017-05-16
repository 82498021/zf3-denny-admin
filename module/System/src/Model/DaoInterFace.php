<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 03/05/2017
 * Time: 08:26
 */

namespace System\Model;



interface DaoInterFace
{
    /**
     * 事务开始
     * @return mixed
     */
    function transactionBegin();

    /**
     * 事务回滚
     * @return mixed
     */
    function transactionRollback();

    /**
     * 事务提交
     * @return mixed
     */
    function transactionCommit();
    /**
     * 根据主键查询数据
     * @param $id
     * @return mixed
     */
    public function findById($id);


    /**
     * 根据条件查询单挑记录
     * @param array $arr 查询条件
     * @param bool|true $status true返回实体,false返回数组
     * @return mixed
     */
    public function selectOne(array $arr=[],$status=true);

    /**
     * 查询分页数据
     * @param array $where
     * @param array $order
     * @return mixed
     */
    public function fetchPaginatedResults(array $where=[],array $order=[]);

    /**
     * 查询所有数据
     * @param array $arr [where,order]
     * @return mixed
     */
    public function selectAll(array $arr);

    /**
     * 更新数据
     * @return Boolean
     */
    public function update($entity);

    /**
     * 新增数据
     * @param $entity
     * @return mixed
     */
    public function create($entity);

    /**
     * 删除记录
     * @param $id
     * @return Boolean
     */
    public function delete($id);
}