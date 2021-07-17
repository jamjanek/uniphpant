<?php

declare(strict_types=1);

namespace App\Uniphpant\Domain;

use App\Uniphpant\Domain\CommonEntity;

/**
 * Class AreaEntity
 * @package App\Uniphpant\Domain
 */
class PageEntity extends CommonEntity
{

    const ALIAS = "page_entity";
    const TABLE="page";

    /**
     * @var string|null
     */
    protected $methods;

    /**
     * @var string|null
     */
    protected $route_uid;

    /**
     * @var string|null
     */
    protected $template_uid;

    /**
     * @var string|null
     */
    protected $status;

    /**
     * @var string|null
     */
    protected $comm;

    /**
     * @var string|null
     */
    protected $created;

    /**
     * @var string|null
     */
    protected $updated;

    public function __construct(\ArrayObject $entityData)
    {
        $this->uid = $entityData->offsetGet('uid');
        $this->methods = $entityData->offsetGet('methods');
        $this->route_uid = $entityData->offsetGet('route_uid');
        $this->template_uid = $entityData->offsetGet('template_uid');
        $this->status = $entityData->offsetGet('status');
        $this->comm = $entityData->offsetGet('comm');
        $this->created = $entityData->offsetGet('created');
        $this->updated = $entityData->offsetGet('updated');
    }

    /**
     * @return string|null
     */
    public function getMethods(): ?string
    {
        return $this->methods;
    }

    /**
     * @param string|null $methods
     * @return PageEntity
     */
    public function setMethods(?string $methods): PageEntity
    {
        $this->methods = $methods;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRouteUid(): ?string
    {
        return $this->route_uid;
    }

    /**
     * @param string|null $route_uid
     * @return PageEntity
     */
    public function setRouteUid(?string $route_uid): PageEntity
    {
        $this->route_uid = $route_uid;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTemplateUid(): ?string
    {
        return $this->template_uid;
    }

    /**
     * @param string|null $template_uid
     * @return PageEntity
     */
    public function setTemplateUid(?string $template_uid): PageEntity
    {
        $this->template_uid = $template_uid;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     * @return PageEntity
     */
    public function setStatus(?string $status): PageEntity
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getComm(): ?string
    {
        return $this->comm;
    }

    /**
     * @param string|null $comm
     * @return PageEntity
     */
    public function setComm(?string $comm): PageEntity
    {
        $this->comm = $comm;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCreated(): ?string
    {
        return $this->created;
    }

    /**
     * @param string|null $created
     * @return PageEntity
     */
    public function setCreated(?string $created): PageEntity
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUpdated(): ?string
    {
        return $this->updated;
    }

    /**
     * @param string|null $updated
     * @return PageEntity
     */
    public function setUpdated(?string $updated): PageEntity
    {
        $this->updated = $updated;
        return $this;
    }



    public function toArray(): array
    {
        return [
            'uid' => $this->getUid(),
            'methods' => $this->getMethods(),
            'route_uid' => $this->getRouteUid(),
            'template_uid' => $this->getTemplateUid(),
            'status' => $this->getStatus(),
            'comm' => $this->getComm(),
            'created' => $this->getCreated(),
            'updated' => $this->getUpdated()
        ];
    }

}
