<?php

declare(strict_types=1);

namespace App\Uniphpant\Domain;

/**
 * Class EntityTrait
 * @package App\Uniphpant\Domain
 */
trait EntityTrait

    /**
     * @var null|string
     */{
    protected ?string $uid;

    public function getIdentifier():?string
    {
        return $this->{self::IDENTIFIER};
    }

    public function getUid():?string
    {
        return $this->uid;
    }
    public function setUid(string $uid):self
    {
        $this->uid = $uid;

        return $this;
    }
}
