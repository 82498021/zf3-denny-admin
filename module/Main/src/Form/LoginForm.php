<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 02/05/2017
 * Time: 14:23
 */

namespace Main\Form;


use Main\Entity\ManagerEntity;
use Zend\Form\Form;
use Zend\Hydrator\Reflection as ReflectionHydrator;

class LoginForm extends Form
{


    public function init()
    {

        $this->setHydrator(new ReflectionHydrator());
        $this->setObject(new ManagerEntity());


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
            'type' => 'captcha',
            'name' => 'captcha',
            'options' => [
                'label' => '验证码',
                'captcha'=>[
                    'class'=>'image',
                    'font'=>__DIR__.'/msyh.ttf',
                    'dotNoiseLevel'=>10,
                    'lineNoiseLevel'=>1,
                    'width'=>300,
                    'height'=>40,
                    'Wordlen'=>2
                ]
            ],
            'attributes'=>[
                'class'=>'form-control',
                'placeholder'=>'验证码',
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


}