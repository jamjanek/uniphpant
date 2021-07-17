<?php

declare(strict_types=1);

namespace App\Uniphpant\Domain;

use App\Uniphpant\Domain\CommonEntity;

/**
 * Class AreaEntity
 * @package App\Uniphpant\Domain
 */
class TemplateEntity extends CommonEntity
{

    const ALIAS = "template_entity";
    const TABLE="template";

    protected string $route_uid;
    protected ?string $type;
    protected ?string $location;
    protected ?string $name;
    protected ?string $label;
    protected string $status;
    protected ?string $comm;
    protected string $created;
    protected ?string $updated;

    public function __construct(\ArrayObject $entityData)
    {
        $this->uid = $entityData->offsetGet('uid');
        $this->route_uid = $entityData->offsetGet('route_uid');
        $this->type = $entityData->offsetGet('type');
        $this->location = $entityData->offsetGet('location');
        $this->name = $entityData->offsetGet('name');
        $this->label = $entityData->offsetGet('label');
        $this->status = $entityData->offsetGet('status');
        $this->comm = $entityData->offsetGet('comm');
        $this->created = $entityData->offsetGet('created');
        $this->updated = $entityData->offsetGet('updated');
    }

    /**
     * @return false|mixed|string
     */
    public function getRouteUid()
    {
        return $this->route_uid;
    }

    /**
     * @param false|mixed|string $route_uid
     * @return TemplateEntity
     */
    public function setRouteUid($route_uid)
    {
        $this->route_uid = $route_uid;
        return $this;
    }

    /**
     * @return false|mixed|string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param false|mixed|string|null $type
     * @return TemplateEntity
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return false|mixed|string|null
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param false|mixed|string|null $location
     * @return TemplateEntity
     */
    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return false|mixed|string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param false|mixed|string|null $name
     * @return TemplateEntity
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return false|mixed|string|null
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param false|mixed|string|null $label
     * @return TemplateEntity
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return false|mixed|string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param false|mixed|string $status
     * @return TemplateEntity
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return false|mixed|string|null
     */
    public function getComm()
    {
        return $this->comm;
    }

    /**
     * @param false|mixed|string|null $comm
     * @return TemplateEntity
     */
    public function setComm($comm)
    {
        $this->comm = $comm;
        return $this;
    }

    /**
     * @return false|mixed|string
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param false|mixed|string $created
     * @return TemplateEntity
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return false|mixed|string|null
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param false|mixed|string|null $updated
     * @return TemplateEntity
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'uid' => $this->getUid(),
            'route_uid' => $this->getRouteUid(),
            'type' => $this->getType(),
            'location' => $this->getLocation(),
            'name' => $this->getName(),
            'label' => $this->getLabel(),
            'status' => $this->getStatus(),
            'comm' => $this->getComm(),
            'created' => $this->getCreated(),
            'updated' => $this->getUpdated()
        ];
    }

}
