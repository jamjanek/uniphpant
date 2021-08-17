<?php
namespace Application\Shrt\Form;

use FormGenerator\Entity\ElementEntity as ElementEntity;
use FormGenerator\Hydrator\InputNameStrategy;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;

class CollectionFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function __construct()
    {
        parent::__construct('collection');

        $hydrator = new ClassMethodsHydrator(true);
//        $hydrator->addStrategy('name', new InputNameStrategy());

        $this->setHydrator($hydrator)
            //->setObject(new ElementEntity())
            ->setAttribute('class', 'collection-item')
            ->setAttribute('name', 'collection-item')
        ;

        $this->setLabel('Collection');

        $this->add([
            'type' => 'Zend\Form\Element\Button',
            'name' => 'remove_collection',
            'options' => [
                'label' => 'Remove Link',
            ],
            'attributes' => [
                'id' => 'remove-collection',
                'class' => 'btn btn-sm btn-danger float-right',
                'onClick' => 'javascript:formCreate.remove($(this),"collection");return false;',
            ],
        ],['priority'=>200]);

        $this->add([
            'name' => 'url',
            'options' => [
                'label' => 'Url',
                'label_attributes' => [
                    'class' => 'control-label',
                ],
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => '(url)',
            ],
        ]);

        $this->add([
            'type' => 'Zend\Form\Element\Button',
            'name' => 'add_element',
            'options' => [
                'label' => 'Add Link',
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
                'count' => 1,
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

        // use_as_base_fieldset
/*
        $this->add([
            'type' => 'FormGenerator\Form\FieldsetOptionsFieldset',
            'name' => 'label',
            'options' => [
                'label' => 'Fieldset Options',
            ],
        ]);

        $this->add([
            'type' => 'Zend\Form\Element\Button',
            'name' => 'add_attribute',
            'options' => [
                'label' => 'New Element Attribute',
            ],
            'attributes' => [
                'id' => 'add-attribute',
                'class' => 'btn btn-xs btn-primary',
                'onClick' => 'javascript:formCreate.add($(this),"attribute");return false;',
            ],
        ]);

        $this->add([
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'attributes',
            'options' => [
                'label' => 'Attributes',
                'count' => 0,
                'should_create_template' => true,
                'allow_add' => true,
                'allow_remove' => true,
                'template_placeholder' => '__index_form_element_attribute__',
                'target_element' => [
                    'type' => 'FormGenerator\Form\AttributeFieldset',
                ],
            ],
            'attributes' => [
                'class' => 'attribute-collection container-attribute-collection',
                'data-template-index-placeholder' => '__index_form_element_attribute__',
            ],
        ]);

        $this->add([
            'type' => 'Zend\Form\Element\Button',
            'name' => 'add_option',
            'options' => [
                'label' => 'New Option',
            ],
            'attributes' => [
                'id' => 'add-option',
                'class' => 'btn btn-xs btn-primary',
                'onClick' => 'javascript:formCreate.add($(this),"option");return false;',
            ],
        ]);
        $this->add([
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'options',
            'options' => [
                'label' => 'Options',
                'count' => 0,
                'should_create_template' => true,
                'allow_add' => true,
                'allow_remove' => true,
                'template_placeholder' => '__index_form_element_option__',
                'target_element' => [
                    'type' => 'FormGenerator\Form\OptionFieldset',
                ],
            ],
            'attributes' => [
                'class' => 'option-collection container-option-collection',
                'data-template-index-placeholder' => '__index_form_element_option__',
            ],
        ]);

        $this->add([
            'type' => 'Zend\Form\Element\Button',
            'name' => 'add_label_attribute',
            'options' => [
                'label' => 'New Label Attribute',
            ],
            'attributes' => [
                'id' => 'add-label_attribute',
                'class' => 'btn btn-xs btn-primary',
                'onClick' => 'javascript:formCreate.add($(this),"label_attribute");return false;',
            ],
        ]);

        $this->add([
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'label_attributes',
            'options' => [
                'label' => 'Label Attributes',
                'count' => 0,
                'should_create_template' => true,
                'allow_add' => true,
                'allow_remove' => true,
                'template_placeholder' => '__index_form_element_label_attribute__',
                'target_element' => [
                    'type' => 'FormGenerator\Form\LabelAttributeFieldset',
                ],
            ],
            'attributes' => [
                'class' => 'label_attribute-collection container-label_attribute-collection',
                'data-template-index-placeholder' => '__index_form_element_label_attribute__',
            ],
        ]);

        $this->add([
            'type' => 'Zend\Form\Element\Button',
            'name' => 'add_label_option',
            'options' => [
                'label' => 'New Label Option',
            ],
            'attributes' => [
                'id' => 'add-label_option',
                'class' => 'btn btn-xs btn-primary',
                'onClick' => 'javascript:formCreate.add($(this),"label_option");return false;',
            ],
        ]);

        $this->add([
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'label_options',
            'options' => [
                'label' => 'Label Options',
                'count' => 0,
                'should_create_template' => true,
                'allow_add' => true,
                'allow_remove' => true,
                'template_placeholder' => '__index_form_element_label_option__',
                'target_element' => [
                    'type' => 'FormGenerator\Form\LabelOptionFieldset',
                ],
            ],
            'attributes' => [
                'class' => 'label_option-collection container-label_option-collection',
                'data-template-index-placeholder' => '__index_form_element_label_option__',
            ],
        ]);
*/
    }

    public function getInputFilterSpecification()
    {
        return [
            'name' => [
                'required' => false,
            ],
            'type' => [
                'required' => true,
            ],
        ];
    }
}
