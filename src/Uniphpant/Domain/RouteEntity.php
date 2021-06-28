<?php

declare(strict_types=1);

namespace App\Uniphpant\Domain;

use App\Uniphpant\Domain\CommonEntity;

/**
 * Class RouteEntity
 * @package App\Uniphpant\Domain
 */
class RouteEntity extends CommonEntity
{
    const ALIAS = "route_entity";
    const TABLE="route";

    /**
     * @var string
     */
    protected $uid;

    /**
     * @var string|null
     */
    protected $route_name;

    /**
     * @var string|null
     */
    protected $methods;

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

    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getUid(): string
    {
        return $this->uid;
    }

    /**
     * @param string $uid
     * @return RouteEntity
     */
    public function setUid(string $uid): RouteEntity
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRouteName(): ?string
    {
        return $this->route_name;
    }

    /**
     * @param string|null $route_name
     * @return RouteEntity
     */
    public function setRouteName(?string $route_name): RouteEntity
    {
        $this->route_name = $route_name;
        return $this;
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
     * @return RouteEntity
     */
    public function setMethods(?string $methods): RouteEntity
    {
        $this->methods = $methods;
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
     * @return RouteEntity
     */
    public function setStatus(?string $status): RouteEntity
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
     * @return RouteEntity
     */
    public function setComm(?string $comm): RouteEntity
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
     * @return RouteEntity
     */
    public function setCreated(?string $created): RouteEntity
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
     * @return RouteEntity
     */
    public function setUpdated(?string $updated): RouteEntity
    {
        $this->updated = $updated;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'uid' => $this->getUid(),
            'route_name' => $this->getRouteName(),
            'methods' => $this->getMethods(),
            'status' => $this->getStatus(),
            'comm' => $this->getComm(),
            'created' => $this->getCreated(),
            'updated' => $this->getUpdated()
        ];
    }

}
