<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 05/05/2017
 * Time: 09:06
 */

namespace Main\Controller\Admin;


use Main\Form\ResourceForm;
use Main\InterFaces\Model\ResourcesModelInterFace;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Plugin\FlashMessenger\FlashMessenger;
use Zend\View\Model\ViewModel;

class ResourceController extends AbstractActionController
{
    /**
     * @var ResourcesModelInterFace
     */
    private $resourcesModel;
    /**
     * @var ResourceForm
     */
    private $form;

    function __construct(ResourcesModelInterFace $resourcesModel, ResourceForm $form)
    {
        $this->resourcesModel = $resourcesModel;

        $this->form = $form;
    }


    function indexAction()
    {

        $list = $this->resourcesModel->multiResources(['category' => 'user']);

        return ['list' => $list];
    }


    function createAction()
    {

        $id = $this->params()->fromRoute('id');

        if (!empty($id)) {
            /**
             * @var \Main\Entity\ResourcesEntity $resource
             */
            $resource = $this->resourcesModel->findById($id);

            $resource->setAction(null)
                ->setIco(null)
                ->setParentId($resource->getId())
                ->setId(null)
                ->setTitle(null)
                ->setStatus(1);

            $this->form->bind($resource);
        }

        $viewModel = new ViewModel(['form' => $this->form]);

        $request = $this->getRequest();

        if (!$this->getRequest()->isPost()) {
            return $viewModel;
        }

        $this->form->setData($request->getPost());

        if (!$this->form->isValid()) {
            return $viewModel;
        }

        /**
         * @var \Main\Entity\ResourcesEntity $entity
         */
        $entity = $this->form->getData();

        try {
            $entityId = $this->resourcesModel->create($entity);

            $entity->setId($entityId)->setSort($entityId);

            $this->resourcesModel->update($entity);
            $this->flashMessenger()->addSuccessMessage("信息新增成功!");
        } catch (\Exception $ex) {
            $this->flashMessenger()->addErrorMessage($ex->getMessage());
        }

        return $this->redirect()->toRoute('admin/resources');
    }


    function updateAction()
    {

        $id = $this->params()->fromRoute('id');

        if (empty($id))
            return $this->redirect()->toRoute('admin/resources');

        $resource = $this->resourcesModel->findById($id);

        $this->form->bind($resource);

        $viewModel = new ViewModel(['form' => $this->form]);

        if (!$this->getRequest()->isPost())
            return $viewModel;

        $this->form->setData($this->getRequest()->getPost());

        if (!$this->form->isValid())
            return $viewModel;

        /**
         * @var \Main\Entity\ResourcesEntity $entity
         */
        $entity = $this->form->getData();

        $status=$this->resourcesModel->update($entity);

        if ($status) {
            $this->flashMessenger()->addSuccessMessage("信息修改成功!");
        } else {
            $this->flashMessenger()->addErrorMessage("信息修改失败!");
            return $viewModel;
        }

        return $this->redirect()->toRoute('admin/resources');

    }


    function deleteAction()
    {


        $id = $this->params()->fromRoute('id');

        if (empty($id)) {

            $this->flashMessenger()->addErrorMessage("没有删除记录标识!");

            return $this->redirect()->toRoute('admin/resources');
        }
        $status = $this->resourcesModel->delete($id);

        if ($status) {
            $this->flashMessenger()->addSuccessMessage("记录删除成功!");
        } else {
            $this->flashMessenger()->addErrorMessage("记录删除失败或没有该记录!");
        }


        return $this->redirect()->toRoute('admin/resources');
    }

}