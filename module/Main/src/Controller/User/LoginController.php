<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 2017/5/14
 * Time: 13:23
 */

namespace Main\Controller\User;


use Main\Form\MemberLoginForm;
use Main\InterFaces\Model\MemberModelInterFace;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Authentication\Storage\Session;
use Zend\Mvc\Controller\AbstractActionController;

class LoginController extends AbstractActionController
{
    /**
     * @var string
     */
    private $layout = "layout/empty";
    /**
     * @var MemberLoginForm
     */
    private $form;
    /**
     * @var MemberModelInterFace
     */
    private $memberModel;

    /**
     * @var AuthenticationServiceInterface
     */
    private $authService;

    /**
     * @var Session
     */
    private $storage;

    public function __construct(MemberModelInterFace $memberModel,
                                AuthenticationServiceInterface $authService,
                                Session $storage,MemberLoginForm $form)
    {
        $this->memberModel = $memberModel;
        $this->authService = $authService;
        $this->storage = $storage;
        $this->form=$form;
    }

    function loginAction(){
        /**
         * @var \Zend\Stdlib\Parameters $postData
         */
        $postData = $this->getRequest()->getPost();

        $this->form->setData($postData);

        if ($this->form->isValid()) {
            /**
             * @var \Main\Entity\MemberEntity $memberEntity
             */
            $memberEntity = $this->form->getData();
            /**
             * @var \Zend\Authentication\AuthenticationService $authenticate
             */
            $authenticate = $this->authService;
            /**
             * @var \Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter $adapter
             */
            $adapter = $authenticate->getAdapter();

            $adapter->setCredential($memberEntity->getPassword())
                ->setIdentity($memberEntity->getMail());
            /**
             * @var \Zend\Authentication\Result $result
             */
            $result = $adapter->authenticate();


            if($result->isValid()){
                $this->authService->setStorage($this->storage);

                $this->authService->getStorage()->write($result->getIdentity());


            }

        }

        echo json_encode(['status'=>$result->getCode(),'msg'=>$this->getMsn($result->getCode())]);
        exit(0);
    }

    private function getMsn($id){
        $data=[
            '-3'=>'密码输入错误!',
            '-1'=>'您输入的账号不存在!',
            '1'=>'登录成功!'
        ];

        return $data[$id];
    }

    function registerAction(){

        echo 'register';

        die;
    }


    public function outAction()
    {
        if ($this->authService->hasIdentity()) {

            $this->authService->clearIdentity();
            $this->flashmessenger()->addMessage("您已经退出登录了!");
        }

        return $this->redirect()->toRoute('home/blog');
    }

}