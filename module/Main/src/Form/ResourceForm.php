<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 05/05/2017
 * Time: 14:07
 */

namespace Main\Form;


use Main\Entity\ResourcesEntity;
use Zend\Form\Form;
use Zend\Hydrator\Reflection as ReflectionHydrator;

class ResourceForm extends Form
{


    public function init()
    {

        $this->setHydrator(new ReflectionHydrator());
        $this->setObject(new ResourcesEntity());

        $this->add([
            'type' => 'select',
            'name' => 'category',
            'options' => [
                'label' => '分类',
                'empty_option'   => '---请选择分类---',
                'value_options' =>[
                    'admin'=>'后台模块',
                    'home'=>'前台模块',
                    'api'=>'API接口',
                    'user'=>'用户模块'
                ]
            ],
            'attributes'=>[
                'placeholder'=>'分类',
                'required'=>true
            ]
        ]);


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
            'type' => 'text',
            'name' => 'router',
            'options' => [
                'label' => '路由',
            ],
            'attributes'=>[
                'placeholder'=>'路由',
                'required'=>true
            ]
        ]);


        $this->add([
            'type' => 'text',
            'name' => 'module',
            'options' => [
                'label' => 'Module',
            ],
            'attributes'=>[
                'placeholder'=>'Module',
                'required'=>true
            ]
        ]);


        $this->add([
            'type' => 'text',
            'name' => 'controller',
            'options' => [
                'label' => 'Controller',
            ],
            'attributes'=>[
                'placeholder'=>'Controller',
            ]
        ]);


        $this->add([
            'type' => 'text',
            'name' => 'action',
            'options' => [
                'label' => 'Action',
            ],
            'attributes'=>[
                'placeholder'=>'Action',
            ]
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'ico',
            'options' => [
                'label' => 'Ico',
            ],
            'attributes'=>[
                'placeholder'=>'Ico',
            ]
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'class',
            'options' => [
                'label' => 'Class',
            ],
            'attributes'=>[
                'placeholder'=>'Class',
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
            'name'=>'parent_id'
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




}