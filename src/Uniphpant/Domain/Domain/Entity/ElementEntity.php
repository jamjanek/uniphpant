<?php
namespace Application\Shrt\Entity;

class ElementEntity
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $label;

    /**
     * @var array
     */
    protected $attributes;


    /**
     * @var array
     */
    protected $label_attributes;


    /**
     * @var array
     */
    protected $label_options;

    /**
     * @var array
     */
    protected $filters;
    /**
     * @var array
     */
    protected $options;

    /**
     * @var array
     */
    protected $validators;

    /**
     * @var boolean
     */
    protected $required;

    /**
     * @var ElementCheckboxEntity
     */
    protected $elementCheckbox;

    /**
     * @var ElementRadioEntity
     */
    protected $elementRadio;

    /**
     * @var ElementSelectEntity
     */
    protected $elementSelect;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ElementEntity
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return ElementEntity
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return array
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param array $label
     * @return ElementEntity
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return array
     */
    public function getLabelAttributes()
    {
        return $this->label_attributes;
    }

    /**
     * @param array $label_attributes
     * @return ElementEntity
     */
    public function setLabelAttributes($label_attributes)
    {
        $this->label_attributes = $label_attributes;
        return $this;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     * @return ElementEntity
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @param array $filters
     * @return ElementEntity
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;
        return $this;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return ElementEntity
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return array
     */
    public function getValidators()
    {
        return $this->validators;
    }

    /**
     * @param array $validators
     * @return ElementEntity
     */
    public function setValidators($validators)
    {
        $this->validators = $validators;
        return $this;
    }

    /**
     * @return bool
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * @param bool $required
     * @return ElementEntity
     */
    public function setRequired($required)
    {
        $this->required = $required;
        return $this;
    }

    /**
     * @return ElementCheckboxEntity
     */
    public function getElementCheckbox()
    {
        return $this->elementCheckbox;
    }

    /**
     * @param ElementCheckboxEntity $elementCheckbox
     * @return ElementEntity
     */
    public function setElementCheckbox(ElementCheckboxEntity $elementCheckbox)
    {
        $this->elementCheckbox = $elementCheckbox;
        return $this;
    }

    /**
     * @return ElementRadioEntity
     */
    public function getElementRadio()
    {
        return $this->elementRadio;
    }

    /**
     * @param ElementRadioEntity $elementRadio
     * @return ElementEntity
     */
    public function setElementRadio(ElementRadioEntity $elementRadio)
    {
        $this->elementRadio = $elementRadio;
        return $this;
    }

    /**
     * @return ElementSelectEntity
     */
    public function getElementSelect()
    {
        return $this->elementSelect;
    }

    /**
     * @param ElementSelectEntity $elementSelect
     * @return ElementEntity
     */
    public function setElementSelect(ElementSelectEntity $elementSelect)
    {
        $this->elementSelect = $elementSelect;
        return $this;
    }

    /**
     * @return array
     */
    public function getLabelOptions()
    {
        return $this->label_options;
    }

    /**
     * @param array $label_options
     * @return ElementEntity
     */
    public function setLabelOptions($label_options)
    {
        $this->label_options = $label_options;
        return $this;
    }

    public function toArray()
    {
        return [
            'name' => $this->getName(),
            'type' => $this->getType(),
            'required' => $this->getRequired(),
            'attributes' => $this->getAttributes(),
            'label' => $this->getLabel(),
            'label_attributes' => $this->getLabelAttributes(),
            'label_options' => $this->getLabelOptions(),
            'filters' => $this->getFilters(),
            'options' => $this->getOptions(),
            'validators' => $this->getValidators(),
            'elementCheckbox' => $this->getElementCheckbox(),
            'elementRadio' => $this->getElementRadio(),
            'elementSelect' => $this->getElementSelect(),
        ];
    }
}
