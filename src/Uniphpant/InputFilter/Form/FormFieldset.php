<?php
namespace Application\Shrt\Form;

use Application\Shrt\Entity\FormEntity as FormEntity;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use FormGenerator\Hydrator\InputNameStrategy;

class FormFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('create_form');

        $hydrator = new ClassMethodsHydrator(true);
//        $hydrator->addStrategy('name', new InputNameStrategy());

        $this->setHydrator($hydrator)
//            ->setObject(new FormEntity())
        ;
/*
        $this->add([
            'type' => 'FormGenerator\Form\FormOutputFieldset',
            'name' => 'output',
            'options' => [
                'label' => 'Output',
            ],
            'attributes' => [
                'class' => 'form_output-collection container-form_output-collection',
            ],
        ]);
*/
//        $this->add([
//            'type' => 'FormGenerator\Form\FormBasicFieldset',
//            'name' => 'basic',
//            'options' => [
//                'label' => 'Form',
//            ],
//            'attributes' => [
//                'class' => 'form_basic-collection container-form_basic-collection',
//            ],
//        ]);

        $this->add([
            'type' => 'Zend\Form\Element\Button',
            'name' => 'add_element',
            'options' => [
                'label' => 'Add Element',
            ],
            'attributes' => [
                'id' => 'add-element',
                'class' => 'btn btn-primary',
                'onClick' => 'javascript:formCreate.add($(this),"element");return false;',
            ],
        ]);

        $this->add([
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'elements',
            'options' => [
                'label' => 'Elements',
                'count' => 2,
                'should_create_template' => true,
                'allow_add' => true,
                'allow_remove' => true,
                'template_placeholder' => '__index_form_element__',
                'target_element' => [
                    'type' => 'Application\Shrt\Form\ElementFieldset',
                ],
            ],
            'attributes' => [
                'class' => 'element-collection',
                'data-template-index-placeholder' => '__index_form_element__'
            ],
        ]);

    }

    public function getInputFilterSpecification()
    {
        return [];
    }
}
