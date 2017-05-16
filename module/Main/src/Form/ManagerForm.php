<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 02/05/2017
 * Time: 14:23
 */

namespace Main\Form;


use Main\Entity\ManagerEntity;

use Main\Options\RoleOptionsAwareInterface;
use Main\Options\RoleOptionsTrait;
use Zend\Form\Form;
use Zend\Hydrator\Reflection as ReflectionHydrator;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;

class ManagerForm extends Form implements RoleOptionsAwareInterface
{

    use RoleOptionsTrait;


    public function init()
    {

        $this->setHydrator(new ReflectionHydrator());
        $this->setObject(new ManagerEntity());
        $this->setInputFilter($this->inputFilter());


        $this->add([
            'type' => 'text',
            'name' => 'username',
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
            'type' => 'text',
            'name' => 'nick_name',
            'options' => [
                'label' => '昵称',
            ],
            'attributes'=>[
                'class'=>'form-control',
                'placeholder'=>'昵称',
                'required'=>true
            ]
        ]);

        $this->add([
            'type' => 'MultiCheckbox',
            'name' => 'roles',
            'options' => [
                'label' => '角色',
                'value_options' =>$this->roleOptions->getRoles()
            ]
        ]);


        $this->add([
            'type' => 'radio',
            'name' => 'status',
            'options' => [
                'label' => '状态',
                'value_options' =>[
                    '1'=>'启用',
                    '0'=>'禁用'
                ]
            ],
            'attributes'=>[
                'placeholder'=>'状态',
                'value' => '1'

            ]
        ]);


        $this->add([
            'type'=>'hidden',
            'name'=>'id'
        ]);

        $this->add([
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => [
                'class'=>'btn btn-primary',
                'value' => '提交',
            ],
        ]);
    }


    function inputFilter(){

        $inputFilter=new InputFilter();

        $inputFilter->add([
            'name' => 'roles[]',
            'required' => false

        ]);


        return $inputFilter;
    }

}