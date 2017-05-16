<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 05/05/2017
 * Time: 23:24
 */

namespace System\ViewHelper;


use Main\InterFaces\Model\ResourcesModelInterFace;
use Zend\Mvc\MvcEvent;
use Zend\View\Helper\AbstractHelper;

class ConnectViewHelper extends AbstractHelper
{

    /**
     * @var ResourcesModelInterFace
     */
    private $resourcesModel;
    /**
     * @var MvcEvent
     */
    private $mvcEvent;
    /**
     * @var string
     */
    private $aXsIco='<a class="%s btn-xs" href="%s" %s><i class="%s"></i>  %s</a>';

    private $aXs='<a class="%s btn-xs" href="%s" %s>%s</a>';

    private $aDefault='<a class="%s" href="%s" %s>%s</a>';

    private $aDefaultIco='<a class="%s" href="%s" %s><i class="%s"></i>  %s</a>';

    function __construct(ResourcesModelInterFace $resourcesModel, MvcEvent $event)
    {

        $this->resourcesModel = $resourcesModel;

        $this->mvcEvent = $event;

    }


    /**
     * @return \Zend\Mvc\ApplicationInterface
     */
    private function getApplication(){
        return $this->mvcEvent->getApplication();
    }

    /**
     * @return \Zend\ServiceManager\ServiceLocatorInterface
     */
    private function getServiceManager(){
        return self::getApplication()->getServiceManager();
    }

    /**
     * @return \Zend\View\HelperPluginManager
     */
    private function getViewHelperManager(){
        return self::getServiceManager()->get("ViewHelperManager");
    }

    /**
     * @return \Zend\View\Renderer\PhpRenderer
     */
    private function getRenderer(){
        return self::getViewHelperManager()->getRenderer();
    }


    /**
     * 连接按钮小号Ico
     * @param $str
     * @param array $parameter
     * @param array $attribute
     * @return null|string
     */
    function aSmallIco($str,array $parameter=[],array $attribute=[]){

        $where=self::recombinant($str,$parameter);

        /**
         * @var \Main\Entity\ResourcesEntity $entity
         */
        $entity=$this->resourcesModel->selectOne($where);

        if(empty($entity))
            return null;

        return sprintf($this->aXsIco,$entity->getClass(),self::getRenderer()->url($str,$parameter),$this->getAttribute($attribute),$entity->getIco(),$entity->getTitle());
    }

    /**
     * @param array $arr
     * @return string
     */
    private function getAttribute(array $arr){


        if(empty($arr))
            return '';

        $str=null;

        foreach($arr as $key=>$val){
            $str.=$key.'="'.$val.'"  ';
        }

        return $str;
    }


    /**
     * 连接按钮小号
     * @param $str
     * @param array $parameter
     * @param array $attribute
     * @return null|string
     */
    function aSmall($str,array $parameter=[],array $attribute=[]){

        $where=self::recombinant($str,$parameter);

        /**
         * @var \Main\Entity\ResourcesEntity $entity
         */
        $entity=$this->resourcesModel->selectOne($where);

        if(empty($entity))
            return null;

        return sprintf($this->aXs,$entity->getClass(),self::getRenderer()->url($str,$parameter),$this->getAttribute($attribute),$entity->getTitle());
    }

    /**
     * @param $str
     * @param $parameter
     * @return null
     */
    private function recombinant($str,$parameter){

        if(isset($parameter['action']))
            $where['action']=$parameter['action'];

        $arr=explode('/',$str);

        if(!is_array($arr))
            return null;

        $where['category']=$arr[0];

        unset($arr[0]);

        $router=null;

        foreach($arr as $v){
            $router.=$router==null?$v:'/'.$v;
        }

        $where['router']=$router;

        return $where;
    }


    /**
     * 连接按钮
     * @param $str
     * @param array $parameter
     * @param array $attribute
     * @return null|string
     */
    function aDefault($str,array $parameter=[],array $attribute=[]){

        $where=self::recombinant($str,$parameter);

        /**
         * @var \Main\Entity\ResourcesEntity $entity
         */
        $entity=$this->resourcesModel->selectOne($where);

        if(empty($entity))
            return null;

        return sprintf($this->aDefault,$entity->getClass(),self::getRenderer()->url($str,$parameter),$this->getAttribute($attribute),$entity->getTitle());
    }

    /**
     * 连接按钮
     * @param $str
     * @param array $parameter
     * @param array $attribute
     * @return null|string
     */
    function aDefaultIco($str,array $parameter=[],array $attribute=[]){

        $where=self::recombinant($str,$parameter);

        /**
         * @var \Main\Entity\ResourcesEntity $entity
         */
        $entity=$this->resourcesModel->selectOne($where);

        if(empty($entity))
            return null;

        return sprintf($this->aDefaultIco,$entity->getClass(),self::getRenderer()->url($str,$parameter),$this->getAttribute($attribute),$entity->getIco(),$entity->getTitle());
    }




}