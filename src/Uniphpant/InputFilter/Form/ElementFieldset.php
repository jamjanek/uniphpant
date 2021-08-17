<?php
namespace Application\Shrt\Form;

use Application\Shrt\Entity\ElementEntity as ElementEntity;
use FormGenerator\Hydrator\InputNameStrategy;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;

class ElementFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function __construct()
    {
        parent::__construct('element');

        $hydrator = new ClassMethodsHydrator(true);
//        $hydrator->addStrategy('name', new InputNameStrategy());

        $this->setHydrator($hydrator)
            ->setObject(new ElementEntity())
            ->setAttribute('class', 'element-item')
        ;

        $this->setLabel('Link');

        $this->add([
            'type' => 'Zend\Form\Element\Button',
            'name' => 'remove_element',
            'options' => [
                'label' => 'Remove Element',
            ],
            'attributes' => [
                'id' => 'remove-element',
                'class' => 'btn btn-xs btn-danger float-right',
                'onClick' => 'javascript:formCreate.remove($(this),"element");reindexAllElementsAttributeName($(this));return false;',
            ],
        ]);

        $this->add([
            'name' => 'name',
            'options' => [
                'label' => 'Name',
                'label_attributes' => [
                    'class' => 'control-label',
                ],
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => '(optional)',
            ],
        ]);
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
