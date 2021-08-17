<?php

declare(strict_types=1);

namespace App\Uniphpant\SPA\Area\Domain;

use App\Uniphpant\Domain\CommonEntity;

/**
 * Class AreaEntity
 * @package App\Uniphpant\SPA\Area
 */
class AreaEntity extends CommonEntity
{

    const INDEX = "area";
    const ALIAS = "area_item";
    const TABLE="area";

    /**
     * @var string|null
     */
    protected $section;

    /**
     * @var string|null
     */
    protected $attributes;

    /**
     * @var string|null
     */
    protected $status;

    /**
     * @var string|null
     */
    protected $order;

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

    public function __construct(string $uid) {

    }

    /**
     * @return string|null
     */
    public function getSection(): ?string
    {
        return $this->section;
    }

    /**
     * @param string|null $section
     * @return AreaEntity
     */
    public function setSection(?string $section): AreaEntity
    {
        $this->section = $section;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAttributes(): ?string
    {
        return $this->attributes;
    }

    /**
     * @param string|null $attributes
     * @return AreaEntity
     */
    public function setAttributes(?string $attributes): AreaEntity
    {
        $this->attributes = $attributes;
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
     * @return AreaEntity
     */
    public function setStatus(?string $status): AreaEntity
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOrder(): ?string
    {
        return $this->order;
    }

    /**
     * @param string|null $order
     * @return AreaEntity
     */
    public function setOrder(?string $order): AreaEntity
    {
        $this->order = $order;
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
     * @return AreaEntity
     */
    public function setComm(?string $comm): AreaEntity
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
     * @return AreaEntity
     */
    public function setCreated(?string $created): AreaEntity
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
     * @return AreaEntity
     */
    public function setUpdated(?string $updated): AreaEntity
    {
        $this->updated = $updated;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'uid' => $this->getUid(),
            'section' => $this->getSection(),
            'attributes' => $this->getAttributes(),
            'status' => $this->getUsername(),
            'order' => $this->getUsername(),
            'comm' => $this->getUsername(),
            'created' => $this->getUsername(),
            'updated' => $this->getUsername()
        ];
    }

}
