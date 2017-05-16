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

class RegisterController extends AbstractActionController
{

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
                                Session $storage, MemberLoginForm $form)
    {
        $this->memberModel = $memberModel;
        $this->authService = $authService;
        $this->storage = $storage;
        $this->form = $form;
    }


    function indexAction()
    {

        /**
         * @var \Zend\Stdlib\Parameters $postData
         */
        $postData = $this->getRequest()->getPost();

        $this->form->setData($postData);

        $this->form->setInputFilter($this->form->inputFilter());

        if (!$this->form->isValid()) {
            $arr = [];

            foreach ($this->form->getMessages() as $key => $val) {

                foreach ($val as $k => $v) {

                    $arr[$key] = $v;

                }

            }
            echo json_encode(['status' => -1, 'msg' => $arr]);
            exit(0);
        }


        $entity = $this->form->getData();

        $status = $this->memberModel->createUser($entity);


        if ($status) {
            $json = [
                'status' => 1,
                'msg' => '用户注册成功!'
            ];
        } else {
            $json = [
                'status' => 1,
                'msg' => '用户注册失败!'
            ];
        }
        echo json_encode($json);
        exit(0);

    }

}