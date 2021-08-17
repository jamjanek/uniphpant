<?php
namespace Application\Shrt\Entity;

class FormCreateEntity
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return FormCreateEntity
     */
    public function setUrl(string $url): FormCreateEntity
    {
        $this->url = $url;
        return $this;
    }

}
