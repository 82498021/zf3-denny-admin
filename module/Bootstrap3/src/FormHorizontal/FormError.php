<?php
/**
 * Created by PhpStorm.
 * User: Denny
 * Date: 15/4/2
 * Time: 21:01
 */

namespace Bootstrap3\FormHorizontal;


use Zend\Form\View\Helper\FormElementErrors;

class FormError extends FormElementErrors{

    protected $messageCloseString     = '</p>';
    protected $messageOpenFormat      = '<p class="help-block has-error">';
    protected $messageSeparatorString = '；';

}