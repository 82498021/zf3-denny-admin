<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 03/05/2017
 * Time: 08:32
 */

namespace System\Model;


use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Update;
use Zend\Hydrator\HydratorInterface;
use Zend\Db\TableGateway\Exception\RuntimeException;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class DaoModel implements DaoInterFace
{

    protected $db;

    protected $table;

    protected $entity;

    protected $hydrator;

    public function __construct(AdapterInterface $adapter, HydratorInterface $hydrator, $entity)
    {
        self::getTable();

        $this->db = $adapter;

        $this->hydrator = $hydrator;

        $this->entity = $entity;

    }

    /**
     * 获取链接
     * @return \Zend\Db\Adapter\Driver\ConnectionInterface
     */
    function getConnection(){
        return   $this->db->getDriver()->getConnection();
    }

    /**
     * 事物开始
     * @return \Zend\Db\Adapter\Driver\ConnectionInterface
     */
    function transactionBegin(){
        return  $this->getConnection()->beginTransaction();
    }

    /**
     * 事物回滚
     * @return \Zend\Db\Adapter\Driver\ConnectionInterface
     */
    function transactionRollback(){
        return  $this->getConnection()->rollback();
    }

    /**
     * 事物继续
     * @return \Zend\Db\Adapter\Driver\ConnectionInterface
     */
    function transactionCommit(){
        return  $this->getConnection()->commit();
    }

    /**
     * 获取表
     */
    protected function getTable()
    {

        $arr = explode('\\', get_class($this));

        $class = end($arr);

        $this->table = $this->toUnderScore(str_replace("Model", '', $class));
    }

    //驼峰命名法转下划线风格
    public static function toUnderScore($str){

        $array = array();
        for($i=0;$i<strlen($str);$i++){
            if($str[$i] == strtolower($str[$i])){
                $array[] = $str[$i];
            }else{
                if($i>0){
                    $array[] = '_';
                }
                $array[] = strtolower($str[$i]);
            }
        }

        $result = implode('',$array);
        return $result;
    }
    /**
     * $paginator = $this->table->fetchAll(true);
     * $page = (int) $this->params()->fromQuery('page', 1);
     * $page = ($page < 1) ? 1 : $page;
     * $paginator->setCurrentPageNumber($page);
     * $paginator->setItemCountPerPage(1);
     *
     * view $this->paginationControl($this->paginator,'sliding','partial/paginator',[ 'route' => 'admin/login' ])
     *
     * @param array $where
     * @param array $order
     * @return Paginator
     */
    public function fetchPaginatedResults(array $where=[],array $order=[])
    {
        $select = new Select($this->table);

        $select->order($order);

        $select->where($where);

        $paginatorAdapter = new DbSelect($select, $this->db,self::getHydratingResultSet());

        $paginator = new Paginator($paginatorAdapter);

        return $paginator;
    }

    /**
     * 查询所有数据
     * @param array $arr
     * @return array|HydratingResultSet
     */
    public function selectAll(array $arr=[])
    {
        $sql    = new Sql($this->db);

        $where=isset($arr['where'])?$arr['where']:[];

        $order=isset($arr['order'])?$arr['order']:['id'=>'desc'];

        $limit=isset($arr['limit'])?$arr['limit']:0;

        $select = $sql->select($this->table)->where($where)->order($order);

        if($limit>0)
            $select->limit($limit);

        $stmt   = $sql->prepareStatementForSqlObject($select);

        $result = $stmt->execute();

        if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
            return [];
        }

        $resultSet = self::getHydratingResultSet();

        $resultSet->initialize($result);

        return $resultSet;
    }


    /**
     * 查询单条数据信息
     * @param $id
     * @return array|object
     */
    public function findById($id)
    {

        $sql = new Sql($this->db);

        $select = $sql->select($this->table);

        $select->where(['id = ?' => $id]);

        $stmt = $sql->prepareStatementForSqlObject($select);

        $result = $stmt->execute();

        if (!$result instanceof ResultInterface || !$result->isQueryResult()) {
            return [];
        }

        $resultSet =self::getHydratingResultSet();

        $resultSet->initialize($result);

        $entity = $resultSet->current();

        return $entity;
    }

    /**
     * 查询单挑数据
     * @param array $arr
     * @param bool|true $status
     * @return array|object
     */
    public function selectOne(array $arr=[], $status = true)
    {
        $sql = new Sql($this->db);

        $select = $sql->select($this->table);

        $select->where($arr);

        $stmt = $sql->prepareStatementForSqlObject($select);

        $result = $stmt->execute();

        if (!$result instanceof ResultInterface || !$result->isQueryResult()) {
            return [];
        }

        $resultSet =self::getHydratingResultSet();

        $resultSet->initialize($result);

        $entity = $resultSet->current();

        if($status==false){
            $entity= $resultSet->getHydrator()->extract($entity);
        }

        return $entity;
    }


    /**
     * 新增数据信息
     * @param $entity
     * @return mixed|null
     */
    public function create($entity)
    {
        $insert = new Insert($this->table);

        $insert->values(self::objectToArray($entity));

        $result = self::getResult($insert);

        if (!$result instanceof ResultInterface) {
            throw new RuntimeException(
                'Database error occurred during insert operation'
            );
        }

        $id = $result->getGeneratedValue();

        return $id;

    }


    /**
     * 更新数据信息
     * @param $entity
     * @return mixed
     */
    public function update($entity)
    {
        if (!$entity->getId()) {
            throw new RuntimeException('Cannot update data; missing identifier');
        }

        $update = new Update($this->table);

        $update->set($this->getHydratingResultSet()->getHydrator()->extract($entity));

        $update->where(['id = ?' => $entity->getId()]);

        $result = self::getResult($update);

        if (!$result instanceof ResultInterface) {
            throw new RuntimeException(
                'Database error occurred during data update operation'
            );
        }

        return $result->count()==1?:false;

    }

    /**
     * 删除数据信息
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        if (!$id) {
            throw new RuntimeException('Cannot update data; missing identifier');
        }

        $delete = new Delete($this->table);

        $delete->where(['id = ?' => $id]);
        /**
         * @var \Zend\Db\Adapter\Driver\Pdo\Result $result
         */
        $result = self::getResult($delete);

        if (!$result instanceof ResultInterface) {
            return false;
        }

        return $result->count()==1?:false;
    }


    /**
     * 对象转数组并剔除空字段
     * @param $entity
     * @return array
     */
    protected function objectToArray($entity)
    {
        $saveData = $this->hydrator->extract($entity);

        $saveData = array_filter($saveData, function ($entity) {
            return $entity !== null && !is_array($entity) && !empty($entity);
        });

        return $saveData;
    }


    protected function getHydratingResultSet(){

        return new HydratingResultSet($this->hydrator, $this->entity);

    }

    /**
     * @param $obj
     * @return ResultInterface
     */
    protected function getResult($obj){

        $sql = new Sql($this->db);
        /**
         * @var \Zend\Db\Adapter\Driver\Pdo\Statement $statement
         */
        $statement = $sql->prepareStatementForSqlObject($obj);

        return $statement->execute();

    }

}