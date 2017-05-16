<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 05/05/2017
 * Time: 09:06
 */

namespace Main\Controller\Admin;


use Main\Form\ManagerForm;
use Main\Form\ResourceForm;
use Main\InterFaces\Model\ManagerModelInterFace;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ManagerController extends AbstractActionController
{
    /**
     * @var ManagerModelInterFace
     */
    private $managerModel;
    /**
     * @var ResourceForm
     */
    private $form;

    function __construct(ManagerModelInterFace $managerModel, ManagerForm $form)
    {
        $this->managerModel = $managerModel;

        $this->form = $form;
    }


    function indexAction()
    {


        $paginator = $this->managerModel->fetchPaginatedResults([], ['status' => 'desc','id'=>'desc']);

        $page = (int)$this->params()->fromQuery('page', 1);

        $page = ($page < 1) ? 1 : $page;

        $paginator->setCurrentPageNumber($page);

        $paginator->setItemCountPerPage(PAGING_DATA_NUM);

        return new ViewModel(['list' => $paginator]);
    }


    function createAction()
    {
        $this->form->remove("id");

        $viewModel = new ViewModel(['form' => $this->form]);
        /**
         * @var \Zend\Http\PhpEnvironment\Request $request
         */
        $request = $this->getRequest();

        if (!$this->getRequest()->isPost()) {
            return $viewModel;
        }
        $data = $request->getPost();

        $this->form->setData($data);


        if (!$this->form->isValid()) {
            return $viewModel;
        }

        /**
         * @var \Main\Entity\ManagerEntity $entity
         */
        $entity = $this->form->getData();

        $status = $this->managerModel->createUser($entity);

        if ($status) {
            $this->flashMessenger()->addSuccessMessage("会员新增成功!");
        } else {
            $this->flashMessenger()->addErrorMessage("会员新增失败!");
            return $viewModel;
        }


        return $this->redirect()->toRoute('admin/manager');
    }


    function updateAction()
    {

        $id = $this->params()->fromRoute('id');

        if (empty($id))
            return $this->redirect()->toRoute('admin/manager');
        /**
         * @var \Main\Entity\ManagerEntity $entity
         */
        $entity = $this->managerModel->findById($id);

        $this->form->bind($entity);

        $viewModel = new ViewModel(['form' => $this->form]);

        if (!$this->getRequest()->isPost())
            return $viewModel;

        $this->form->setData($this->getRequest()->getPost());

        if (!$this->form->isValid())
            return $viewModel;


        /**
         * @var \Main\Entity\ManagerEntity $managerEntity
         */
        $managerEntity = $this->form->getData();

        $status = $this->managerModel->updateUser($managerEntity);

        if ($status) {
            $this->flashMessenger()->addSuccessMessage("账号修改成功!");
        } else {
            $this->flashMessenger()->addErrorMessage("账号修改失败!");
            return $viewModel;
        }

        return $this->redirect()->toRoute('admin/manager');

    }


    function deleteAction()
    {


        $id = $this->params()->fromRoute('id');

        if (empty($id)) {

            $this->flashMessenger()->addErrorMessage("没有禁用记录标识!");

            return $this->redirect()->toRoute('admin/resources');
        }
        /**
         * @var \Main\Entity\ManagerEntity $managerEntity
         */
        $managerEntity = $this->managerModel->findById($id);

        $managerEntity->setStatus(false);

        $status=$this->managerModel->update($managerEntity);

        if ($status) {
            $this->flashMessenger()->addSuccessMessage("账号禁用成功!");
        } else {
            $this->flashMessenger()->addErrorMessage("账号禁用失败!");
        }


        return $this->redirect()->toRoute('admin/manager');
    }

    function startAction()
    {


        $id = $this->params()->fromRoute('id');

        if (empty($id)) {

            $this->flashMessenger()->addErrorMessage("没有启用记录标识!");

            return $this->redirect()->toRoute('admin/resources');
        }
        /**
         * @var \Main\Entity\ManagerEntity $managerEntity
         */
        $managerEntity = $this->managerModel->findById($id);

        $managerEntity->setStatus(true);

        $status=$this->managerModel->update($managerEntity);

        if ($status) {
            $this->flashMessenger()->addSuccessMessage("账号启用成功!");
        } else {
            $this->flashMessenger()->addErrorMessage("账号启用失败!");
        }


        return $this->redirect()->toRoute('admin/manager');
    }

    function resetAction()
    {

    }


}