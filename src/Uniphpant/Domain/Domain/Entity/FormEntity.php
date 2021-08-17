<?php
namespace Application\Shrt\Entity;

class FormEntity
{

    /**
     * @var FormBasicEntity
     */
    protected $basic;

    /**
     * @var FormOutputEntity
     */
    protected $output;

    /**
     * @var array
     */
    protected $elements;

    /**
     * @return FormBasicEntity
     */
    public function getBasic()
    {
        return $this->basic;
    }

    /**
     * @param FormBasicEntity $basic
     * @return $this
     */
//    public function setBasic(FormBasicEntity $basic)
//    {
//        $this->basic = $basic;
//        return $this;
//    }

    /**
     * @return FormOutputEntity
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * @param FormOutputEntity $output
     * @return $this
     */
//    public function setOutput(FormOutputEntity $output)
//    {
//        $this->output = $output;
//        return $this;
//    }

    /**
     * @return array
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * @param array $element
     * @return FormEntity
     */
    public function setElements($elements)
    {
        $this->elements = $elements;
        return $this;
    }
}
