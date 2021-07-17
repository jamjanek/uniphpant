<?php

declare(strict_types=1);

namespace App\Uniphpant\Domain;

/**
 * Class EntityInterface
 * @package App\Uniphpant\Domain
 */
interface EntityInterface
{
    public function getIdentifier():?string;
    public function getUid():?string;
    public function setUid(string $uid):self;
}
