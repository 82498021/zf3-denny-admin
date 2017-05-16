<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 04/05/2017
 * Time: 15:47
 */

namespace System\ViewHelper;

use Main\InterFaces\Model\ResourcesModelInterFace;
use Zend\Mvc\MvcEvent;
use Zend\View\Helper\AbstractHelper;


class AdminMenuViewHelper extends AbstractHelper
{
    /**
     * @var ResourcesModelInterFace
     */
    private $resourcesModel;
    /**
     * @var MvcEvent
     */
    private $mvcEvent;

    private $breadcrum = '<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>%s</h2>
        <ol class="breadcrumb">

                <li>
                    <a <href="%s">主页</a>
                </li>
                %s
            <li>
                <strong>%s</strong>
            </li>
        </ol>
    </div>
</div>';


    function __construct(ResourcesModelInterFace $resourcesModel, MvcEvent $event)
    {

        $this->resourcesModel = $resourcesModel;

        $this->mvcEvent = $event;

    }

    /**
     * 菜单
     * @return array|mixed
     */
    function menu()
    {
        $list = $this->resourcesModel->selectAll(['where' => ['status' => 1], 'order' => ['sort' => 'asc']]);

        $list = self::objectToArray($list);

        $list = $this->resourcesModel->combination($list,0);

        return $list;
    }

    /**
     * 面包屑导航
     */
    function breadcrum()
    {

        $where=self::getRouterArr();

        /**
         * @var \Main\Entity\ResourcesEntity $resourceEntity
         */
        $resourceEntity=$this->resourcesModel->selectOne($where);

        if($resourceEntity==false){
            return;
        }

        $resourceList=$this->resourcesModel->getCascade($resourceEntity->getId());

        unset($resourceList[0]);

        krsort($resourceList);

        $str='';

        foreach($resourceList as $val){
            $str.=' <li><a href="';
            if(!empty($val['router']) && !empty($val['category'])){
                $str.=self::getRenderer()->url($val['category'].'/'.$val['router']);
            }else{
                $str.="javascript:void(0);";
            }
            $str.='">'.$val['title'].'</a></li>';
        }

        return sprintf($this->breadcrum,$resourceEntity->getTitle(),self::getRenderer()->url($resourceEntity->getCategory()),$str,$resourceEntity->getTitle());

    }

    function getRouterArr(){
        /**
         * @var \Zend\Router\Http\RouteMatch $routes
         */
        $routes=self::getRouteMatch();

        $routesArr=explode('\\',$routes->getParam("controller"));

        if(!is_array($routesArr))
            return ;

        $controller=strtolower(str_replace(['Controller'],'',end($routesArr)));


        return [
            'category'=>strtolower($routesArr[2]),
            'controller'=>$controller,
            'action'=>$routes->getParam("action"),
            'module'=>strtolower($routesArr[0])
        ];
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
     * @param $objects
     * @return array
     */
    private function objectToArray($objects)
    {
        $array = [];
        /**
         * @var \Main\Entity\ResourcesEntity $val
         */
        foreach ($objects as $key => $val) {
            $array[$val->getId()] = [
                'id'=>$val->getId(),
                'title' => $val->getTitle(),
                'ico' => $val->getIco(),
                'router' => self::joinUrl($val),
                'parent_id' => $val->getParentId(),
                'status' => self::isActive($val)
            ];
        }

        return $array;
    }


    /**
     * @param \Main\Entity\ResourcesEntity $data
     * @return bool
     */
    private function isActive($data)
    {

        $routeName = self::getRouteMatch()->getMatchedRouteName();

        $router=self::getRouterArr();

        if($data->getParentId()==0 && $data->getCategory()==$router['category'] && $data->getModule()==$router['module']){
                return true;

        }

        if ($routeName == $data->getCategory() . '/' . $data->getRouter()) {

                return true;

        }


        return false;
    }

    /**
     * @return null|\Zend\Router\RouteMatch
     */
    private function getRouteMatch()
    {
        return $routeMatch = $this->mvcEvent->getRouteMatch();
    }


    /**
     * @param \Main\Entity\ResourcesEntity $data
     * @return string
     */
    private function joinUrl($data)
    {

        return empty($data->getRouter()) ? null : $data->getCategory() . '/' . $data->getRouter();
    }


}