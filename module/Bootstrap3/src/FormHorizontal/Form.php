<?php
/**
 * Created by PhpStorm.
 * User: Denny
 * Date: 15/4/2
 * Time: 21:01
 */

namespace Bootstrap3\FormHorizontal;



use Zend\Form\FieldsetInterface;
use Zend\Form\FormInterface;
use Zend\Form\View\Helper\Form as Base;

class Form extends Base{

    public function render(FormInterface $form)
    {
        if (method_exists($form, 'prepare')) {
            $form->prepare();
        }

            $form->setAttribute('class', 'form-horizontal');

        $formContent = '';

        foreach ($form as $element) {
            if ($element instanceof FieldsetInterface) {
                $formContent.= $this->getView()->formCollection($element);
            } else {
                $formContent.= $this->getView()->Bootstrap3HorizontalRow($element);
            }
        }

        return $this->openTag($form) . $formContent . $this->closeTag();
    }
}