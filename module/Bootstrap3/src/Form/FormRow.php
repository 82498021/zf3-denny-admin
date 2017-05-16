<?php
/**
 * Created by PhpStorm.
 * User: Denny
 * Date: 15/4/2
 * Time: 21:01
 */

namespace Bootstrap3\Form;



use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormRow as BaseFow;
use Zend\Form\View\Helper\FormElementErrors;

class FormRow extends BaseFow
{

    protected $wap = '<div class="form-group %s">%s%s</div>';

    protected $eleWap = '<div>%s%s</div>';

    protected $eleOption = '<label class="%s"><input type="%s" id="%s" name="%s" value="%s" %s>%s</label>';


    function render(ElementInterface $element, $labelPosition = null)
    {


        $labeWap = [];

        $lable = $element->getLabel();

        $labelHtml = null;

        if (!empty($lable)) {

            $labelHelper = $this->getLabelHelper();

            $labelHtml = $labelHelper($element);

        }

        $input = $element->getAttributes();


        $errorHelper=$this->getElementErrorsHelper();

        $errorHtml=$errorHelper($element);

        if (in_array($input['type'], ['textarea','select','hidden', 'submit', 'buttom', 'text', 'password', 'datetime', 'datetime-local', 'date', 'month', 'time', 'week', 'email', 'tel', 'color'])) {

            if (empty($input['class']) and $input['type']!='hidden') {

                $element->setAttribute('class', 'form-control');

            }

            $elementHelper = $this->getElementHelper();

            $elementInput=$elementHelper($element);

            if($input['type']=='hidden') return $elementInput;

            $elementHtml = sprintf($this->eleWap, $elementInput,$errorHtml);

        }

        if ($input['type'] === 'multi_checkbox' || $input['type'] === 'radio') {

            $valOption = $element->getOptions('value_options');

            $title = $element->getAttributes()['name'];

            $check = is_array($element->getValue()) ? $element->getValue() : [$element->getValue()];

            foreach ($valOption['value_options'] as $key => $val) {

                $checked = null;

                if (in_array($key, $check)) $checked = 'checked="checked"';

                $elementHtml.=sprintf($this->eleOption, $input['type'] == 'radio' ? 'radio-inline' : 'checkbox-inline', $input['type'] == 'radio' ? $input['type'] : 'checkbox', $title, $title, $key, $checked, $val);

            }

            $elementHtml = sprintf($this->eleWap, implode(' ', $labeWap), $elementHtml,$errorHtml);
        }

        $errorColor=$errorHtml?"has-error":null;

        return sprintf($this->wap, $errorColor,$labelHtml, $elementHtml);
    }



    /**
     * Retrieve the FormElementErrors helper
     *
     * @return FormElementErrors
     */
    protected function getElementErrorsHelper()
    {
        if ($this->elementErrorsHelper) {
            return $this->elementErrorsHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->elementErrorsHelper = $this->view->plugin('Bootstrap3FromError');
        }

        if (! $this->elementErrorsHelper instanceof FormElementErrors) {
            $this->elementErrorsHelper = new FormElementErrors();
        }

        return $this->elementErrorsHelper;
    }

}