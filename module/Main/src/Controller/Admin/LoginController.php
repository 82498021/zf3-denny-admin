<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 01/05/2017
 * Time: 22:27
 */

namespace Main\Controller\Admin;


use Main\Form\LoginForm;
use Main\InterFaces\Model\ManagerModelInterFace;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Authentication\Storage\Session;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\ManagerInterface;
use Zend\View\Model\ViewModel;

class LoginController extends AbstractActionController
{
    /**
     * @var string
     */
    private $layout = "layout/empty";
    /**
     * @var LoginForm
     */
    private $form;
    /**
     * @var ManagerInterface
     */
    private $managerModel;

    /**
     * @var AuthenticationServiceInterface
     */
    private $authService;

    /**
     * @var Session
     */
    private $storage;

    public function __construct(ManagerModelInterFace $managerModel,
                                LoginForm $form,
                                AuthenticationServiceInterface $authService,
                                Session $storage)
    {
        $this->managerModel = $managerModel;
        $this->form = $form;
        $this->authService = $authService;
        $this->storage = $storage;
    }


    function indexAction()
    {

        if ($this->getRequest()->isPost()) {
            /**
             * @var \Zend\Stdlib\Parameters $postData
             */
            $postData = $this->getRequest()->getPost();

            $this->form->setData($postData);

            if ($this->form->isValid()) {
                /**
                 * @var \Main\Entity\ManagerEntity $managerEntity
                 */
                $managerEntity = $this->form->getData();
                /**
                 * @var \Zend\Authentication\AuthenticationService $authenticate
                 */
                $authenticate = $this->authService;
                /**
                 * @var \Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter $adapter
                 */
                $adapter = $authenticate->getAdapter();

                $adapter->setCredential($managerEntity->getPassword())
                    ->setIdentity($managerEntity->getUsername());
                /**
                 * @var \Zend\Authentication\Result $result
                 */
                $result = $adapter->authenticate();


                if($result->isValid()){
                    $this->authService->setStorage($this->storage);

                    $this->authService->getStorage()->write($result->getIdentity());

                    return $this->redirect()->toRoute(
                        'admin/index');
                }

            }

        }

        $this->layout($this->layout);

        $viewModel = new ViewModel(['form' => $this->form]);

        return $viewModel;
    }


    public function outAction()
    {
        if ($this->authService->hasIdentity()) {

            $this->authService->clearIdentity();
            $this->flashmessenger()->addMessage("您已经退出登录了!");
        }

        return $this->redirect()->toRoute('admin/login');
    }


}