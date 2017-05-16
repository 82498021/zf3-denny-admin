<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 02/05/2017
 * Time: 14:23
 */

namespace Main\Form;


use Main\Form\Entity\MemberFormEntity;
use Zend\Db\TableGateway\Feature\GlobalAdapterFeature;
use Zend\Form\Form;
use Zend\Hydrator\Reflection as ReflectionHydrator;
use Zend\InputFilter\InputFilter;
use Zend\Validator\Db\NoRecordExists;
use Zend\Validator\EmailAddress;
use Zend\Validator\Identical;
use Zend\Validator\StringLength;

class MemberLoginForm extends Form
{


    public function init()
    {

        $this->setHydrator(new ReflectionHydrator());
        $this->setObject(new MemberFormEntity());


        $this->add([
            'type' => 'text',
            'name' => 'mail',
            'options' => [
                'label' => '用户名',
            ],
            'attributes'=>[
                'class'=>'form-control',
                'placeholder'=>'用户名',
                'required'=>true
            ]
        ]);

        $this->add([
            'type' => 'password',
            'name' => 'password',
            'options' => [
                'label' => '密码',
            ],
            'attributes'=>[
                'class'=>'form-control',
                'placeholder'=>'密码',
                'required'=>true
            ]
        ]);

        $this->add([
            'type' => 'password',
            'name' => 'pass',
            'options' => [
                'label' => '密码',
            ],
            'attributes'=>[
                'class'=>'form-control',
                'placeholder'=>'密码',
                'required'=>true
            ]
        ]);

        $this->add([
            'type' => 'password',
            'name' => 'nick_name',
            'options' => [
                'label' => '密码',
            ],
            'attributes'=>[
                'class'=>'form-control',
                'placeholder'=>'密码',
                'required'=>true
            ]
        ]);



        $this->add([
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => '登录',
            ],
        ]);
    }


    function inputFilter(){

        $inputFilter=new InputFilter();

        $inputFilter->add([
            'name' => 'mail',
            'required' => true,
            'validators'=>[
                [
                    'name' => 'EmailAddress',
                    'options'=>[
                        'messages'=>[
                            EmailAddress::INVALID_FORMAT=>"您输入的电子邮箱格式错误!"
                        ]
                    ]

                ],
                [
                    'name'=>'DbNoRecordExists',
                    'options'=>[
                        'field'=>'mail',
                        'adapter'=>GlobalAdapterFeature::getStaticAdapter(),
                        'table'=>'member',
                        'messages'=>[
                        NoRecordExists::ERROR_RECORD_FOUND=>'该会员已存在请重新输入账号'
                        ]
                    ]
                ]
            ]
        ]);

        $inputFilter->add([
            'name' => 'nick_name',
            'required' => true,
            'validators'=>[
                [
                    'name'=>'DbNoRecordExists',
                    'options'=>[
                        'field'=>'nick_name',
                        'adapter'=>GlobalAdapterFeature::getStaticAdapter(),
                        'table'=>'member',
                        'messages'=>[
                            NoRecordExists::ERROR_RECORD_FOUND=>'该会员已存在请重新输入账号'
                        ]
                    ]
                ]
            ]
        ]);

        $inputFilter->add([
            'name' => 'password',
            'required' => true,
            'validators'=>[
                [
                    'name' => 'stringlength',
                    'options'=>[
                        'min'=>"6",
                        'max'=>"32",
                        'messages'=>[
                           /* Between::NOT_BETWEEN=>"密码长度不能小于%min%大于%max%位!"*/
                            StringLength::INVALID=>'您输入的信息无效',
                            StringLength::TOO_LONG=>'您输入的密码长度大于%max%位,请重新输入',
                            StringLength::TOO_SHORT=>'您输入的密码长度小于%min%位,请重新输入',
                        ]
                    ]

                ]
            ]
        ]);

        $inputFilter->add([
            'name' => 'pass',
            'required' => true,
            'validators'=>[
                [
                    'name' => 'Identical',
                    'options'=>[
                        'token'=>"password",
                        'messages'=>[
                            Identical::NOT_SAME=>"两次密码不一致"
                        ]
                    ]

                ]
            ]
        ]);


        return $inputFilter;
    }

}