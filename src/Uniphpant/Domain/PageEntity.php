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

    public function __construct(
        ?string $uid=null,
        ?string $methods = null,
        ?string $route_uid = null,
        ?string $template_uid = null,
        ?string $status = null,
        ?string $comm = null,
        ?string $created = null,
        ?string $updated = null
    )
    {
        $this->uid = $uid;
        $this->methods = $methods;
        $this->route_uid = $route_uid;
        $this->template_uid = $template_uid;
        $this->status = $status;
        $this->comm = $comm;
        $this->created = $created;
        $this->updated = $updated;
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
    public function setMethods(?string $methods)
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
    public function setRouteUid(?string $route_uid)
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
    public function setTemplateUid(?string $template_uid)
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
    public function setStatus(?string $status)
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
    public function setComm(?string $comm)
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
    public function setCreated(?string $created)
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
    public function setUpdated(?string $updated)
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
