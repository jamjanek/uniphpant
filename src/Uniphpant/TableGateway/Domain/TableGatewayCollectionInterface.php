<?php
declare(strict_types=1);

namespace App\Uniphpant\TableGateway\Domain;

interface TableGatewayCollectionInterface
{
    public function create():TableGatewayCollectionInterface;
    public function getItem():TableGatewayCollectionInterface;
}
