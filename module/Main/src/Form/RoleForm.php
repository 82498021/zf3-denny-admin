<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 05/05/2017
 * Time: 14:07
 */

namespace Main\Form;


use Main\Entity\RoleEntity;
use Zend\Form\Form;
use Zend\Hydrator\Reflection as ReflectionHydrator;
use Zend\InputFilter\InputFilter;

class RoleForm extends Form
{


    public function init()
    {

        $this->setHydrator(new ReflectionHydrator());
        $this->setObject(new RoleEntity());

        $this->add([
            'type' => 'text',
            'name' => 'title',
            'options' => [
                'label' => '名称',
            ],
            'attributes'=>[
                'placeholder'=>'名称',

            ],
            'validator'=>[
                'required'=>true
            ]
        ]);

        $this->add([
            'type' => 'textarea',
            'name' => 'rack',
            'options' => [
                'label' => '描述',
            ],
            'attributes'=>[
                'placeholder'=>'描述',
                'required'=>true
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
            'name' => 'title',
            'required' => true,
            'validators'=>[
                [
                    'name' => 'StringLength',
                    'options' => [
                        'min' => 2,
                        'max' => 128
                    ],
                ]
            ]

        ]);


        return $inputFilter;
    }

}