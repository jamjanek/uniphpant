<?php

declare(strict_types=1);

namespace App\Uniphpant\Domain;

use App\Uniphpant\Domain\EntityInterface;
use App\Uniphpant\Domain\EntityTrait;

/**
 * Class CommonEntity
 * @package App\Uniphpant\Domain
 */
class CommonEntity implements EntityInterface
{
    use EntityTrait;

    const TYPE="entity";
    const IDENTIFIER="uid";
}
