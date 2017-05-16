<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 05/05/2017
 * Time: 14:46
 */

namespace Bootstrap3\Form;

use Zend\Form\Fieldset;
use Zend\Form\FieldsetInterface;
use Zend\Form\FormInterface;
use Zend\Form\View\Helper\Form as Base;


class Form extends Base
{


    public function render(FormInterface $form)
    {
        if (method_exists($form, 'prepare')) {
            $form->prepare();
        }

        $formContent = '';

        foreach ($form as $element) {
            if ($element instanceof FieldsetInterface) {
                $formContent.= $this->getView()->formCollection($element);
            } else {

                $formContent.= $this->getView()->Bootstrap3FormRow($element);
            }
        }

        return $this->openTag($form) . $formContent . $this->closeTag();
    }



}