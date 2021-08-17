<?php

namespace Application\Shrt\Form;

use Zend\Form\Form;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use Application\Shrt\Entity\FormCreateEntity;
use Zend\InputFilter\InputFilter as InputFilter;
use Zend\InputFilter\InputFilterProviderInterface;

class ResultForm extends Form implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('form');

        $this
            ->setAttribute('method', 'post')
            ->setAttribute('id', 'formResult')
            ->setAttribute('class', 'form-collection')
            ->setHydrator(new ClassMethodsHydrator(false))
//            ->setObject(new FormCreateEntity())
//            ->setInputFilter(new InputFilter())
        ;

        $this->add([
            'name' => 'url',
            'options' => [
                'label' => 'Copy your URL',
                'label_attributes' => [
                    'class' => 'control-label w-75 text-left',
                ],
            ],
            'attributes' => [
                'class' => 'form-control w-75 float-left rounded-0',
                'readonly' => 'readonly',
                'id' => 'url-link'
            ],
        ],['priority'=>10]);

        $this->add([
            'name' => 'btn_open',
            'attributes' => [
                'type' => 'button',
                'value' => 'Open Link',
                'class' => 'btn btn-warning w-25 float-right rounded-0',
                'onclick' => 'javascript:openInNewTabFromAttr("url-link");',
            ],
        ],['priority'=>-20]);

        $this->add([
            'name' => 'copy',
            'attributes' => [
                'type' => 'button',
                'value' => 'Copy Link',
                'class' => 'btn btn-lg btn-success w-100 rounded-0 mt-2',
                'onClick' => 'javascript:document.getElementById("url-link").select();document.execCommand("copy");return false;',
            ],
        ],['priority'=>-30]);
    }

    public function getInputFilterSpecification()
    {
        return [];
    }
}