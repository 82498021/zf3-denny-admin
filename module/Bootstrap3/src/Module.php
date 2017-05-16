<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 05/05/2017
 * Time: 14:43
 */

namespace Bootstrap3;


use Bootstrap3\FormHorizontal\FormError;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;
use Zend\ServiceManager\Factory\InvokableFactory;

class Module implements ViewHelperProviderInterface
{

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getViewHelperConfig(){

        return [
            'invokables'=>[
                'BootstrapForm'=>Form\Form::class,
                'Bootstrap3FormRow'=>Form\FormRow::class,
                'Bootstrap3FromError'=>FormError::class,
                'Bootstrap3HorizontalRow'=>FormHorizontal\FormRow::class,
                'Bootstrap3Horizontal'=>FormHorizontal\Form::class
            ],
            'factories'=>[
                Form\Form::class=>InvokableFactory::class,
                Form\FormRow::class=>InvokableFactory::class,
                FormHorizontal\FormRow::class=>InvokableFactory::class,
                FormHorizontal\FormError::class=>InvokableFactory::class,
                FormHorizontal\Form::class=>InvokableFactory::class
            ]
        ];

    }




}