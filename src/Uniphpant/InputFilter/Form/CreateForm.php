<?php

namespace Application\Shrt\Form;

use Zend\Form\Form;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use Application\Shrt\Entity\FormCreateEntity;
use Zend\InputFilter\InputFilter as InputFilter;
use Zend\InputFilter\InputFilterProviderInterface;

class CreateForm extends Form implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('form');

        $this
            ->setAttribute('method', 'post')
            ->setAttribute('id', 'formCreate')
            ->setAttribute('class', 'form-collection')
            ->setHydrator(new ClassMethodsHydrator(false))
            ->setObject(new FormCreateEntity())
            ->setInputFilter(new InputFilter())
        ;

        $this->add([
            'name' => 'url',
            'options' => [
                'label' => 'Paste your URL',
                'label_attributes' => [
                    'class' => 'control-label w-100 text-left rounded-0',
                ],
            ],
            'attributes' => [
                'class' => 'form-control rounded-0',
                'id' => 'form-url',
                'placeholder' => '(url string)',
            ],
        ],['priority'=>30]);

//        $this->add([
//            'type' => 'Application\Shrt\Form\FormFieldset',
//            'name' => 'create_form',
//            'options' => [
//                'use_as_base_fieldset' => true,
//                'label' => 'Create Form',
//            ],
//            'attributes' => [
//                'class' => 'form-item',
//            ],
//        ],['priority'=>10]);

        $this->add([
            'name' => 'submit',
            'attributes' => [
                'type' => 'submit',
                'value' => 'Create Link',
                'class' => 'btn btn-lg btn-primary w-100 rounded-0',
                'onClick' => 'javascript:applicationForm.sendForm();return false;',
            ],
        ],['priority'=>-30]);
    }

    public function getInputFilterSpecification()
    {
        return [
            'url' => [
                'required' => true,
            ],
        ];
    }
}