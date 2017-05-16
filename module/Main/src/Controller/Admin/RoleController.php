<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 2017/5/8
 * Time: 09:02
 */

namespace Main\Controller\Admin;


use Main\Form\RoleForm;
use Main\InterFaces\Model\ResourcesModelInterFace;
use Main\InterFaces\Model\RoleModelInterFace;
use System\Helper\ArrayHelper;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class RoleController extends AbstractActionController
{


    /**
     * @var RoleModelInterFace
     */
    private $roleModel;
    /**
     * @var ResourcesModelInterFace
     */
    private $resourcesModel;
    /**
     * @var RoleForm
     */
    private $form;


    function __construct(RoleModelInterFace $roleModel, RoleForm $form,ResourcesModelInterFace $resourcesModel)
    {
        $this->roleModel = $roleModel;

        $this->resourcesModel=$resourcesModel;


        $this->form = $form;
    }


    function indexAction()
    {

        $paginator=$this->roleModel->fetchPaginatedResults([],['id'=>'desc']);

        $page = (int) $this->params()->fromQuery('page', 1);

        $page = ($page < 1) ? 1 : $page;

        $paginator->setCurrentPageNumber($page);

        $paginator->setItemCountPerPage(PAGING_DATA_NUM);

        return new ViewModel(['list' => $paginator]);
    }


    function createAction()
    {
        $this->form->remove("id");

        $viewModel = new ViewModel(['form' => $this->form]);

        $request = $this->getRequest();

        if (!$this->getRequest()->isPost()) {
            return $viewModel;
        }

        $this->form->setData($request->getPost());

        $this->form->setInputFilter($this->form->inputFilter());

        if (!$this->form->isValid()) {
            return $viewModel;
        }


        /**
         * @var \Main\Entity\RoleEntity $entity
         */
        $entity = $this->form->getData();


        try {
            $this->roleModel->create($entity);

            $this->flashMessenger()->addSuccessMessage("信息新增成功!");
        } catch (\Exception $ex) {
            $this->flashMessenger()->addErrorMessage($ex->getMessage());
        }

        return $this->redirect()->toRoute('admin/role');
    }


    function updateAction()
    {

        $id = $this->params()->fromRoute('id');

        if (empty($id))
            return $this->redirect()->toRoute('admin/role');

        $resource = $this->roleModel->findById($id);

        $this->form->bind($resource);

        $viewModel = new ViewModel(['form' => $this->form]);

        if (!$this->getRequest()->isPost())
            return $viewModel;

        $this->form->setData($this->getRequest()->getPost());

        if (!$this->form->isValid())
            return $viewModel;

        /**
         * @var \Main\Entity\RoleEntity $entity
         */
        $entity = $this->form->getData();

        $status=$this->roleModel->update($entity);

        if ($status) {
            $this->flashMessenger()->addSuccessMessage("信息修改成功!");
        } else {
            $this->flashMessenger()->addErrorMessage("信息修改失败!");
            return $viewModel;
        }

        return $this->redirect()->toRoute('admin/role');

    }


    function deleteAction()
    {


        $id = $this->params()->fromRoute('id');

        if (empty($id)) {

            $this->flashMessenger()->addErrorMessage("没有删除记录标识!");

            return $this->redirect()->toRoute('admin/role');
        }
        $status = $this->roleModel->delete($id);

        if ($status) {
            $this->flashMessenger()->addSuccessMessage("记录删除成功!");
        } else {
            $this->flashMessenger()->addErrorMessage("记录删除失败或没有该记录!");
        }


        return $this->redirect()->toRoute('admin/role');
    }


    function accessAction(){

        $id = $this->params()->fromRoute('id');

        if (empty($id)){
            $this->flashMessenger()->addErrorMessage("请勿非法操作!");

            return $this->redirect()->toRoute('admin/role');
        }

        $roleEntity=$this->roleModel->findById($id);

        if(!$roleEntity){
            $this->flashMessenger()->addErrorMessage("该角色不存在!");

            return $this->redirect()->toRoute('admin/role');
        }

        $list=$this->resourcesModel->multiResources(['category' => 'admin']);

        $viewModel = new ViewModel(['list' => $list,'entity'=>$roleEntity,'access'=>ArrayHelper::stringToArray($roleEntity->getAccess())]);

        if (!$this->getRequest()->isPost()) {
            return $viewModel;
        }

        $status=$this->roleModel->saveAccess($this->getRequest()->getPost());

        if ($status) {
            $this->flashMessenger()->addSuccessMessage("权限设置成功!");
        } else {
            $this->flashMessenger()->addErrorMessage("权限设置失败!");
            return $viewModel;
        }

        return $this->redirect()->toRoute('admin/role');
    }



}