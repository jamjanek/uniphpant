<?php
declare(strict_types=1);

namespace App\Uniphpant\TableGateway\Service;

use Laminas\Db\TableGateway\TableGateway;
use App\Uniphpant\TableGateway\Domain\TableGatewayCollection;

/**
 * Class TableGatewayService
 * @package App\Uniphpant\TableGateway
 */
class TableGatewayService
{
    protected TableGatewayCollection $tableGatewayCollection;

    public function __construct(TableGatewayCollection $tableGatewayCollection)
    {
        $this->tableGatewayCollection = $tableGatewayCollection;
    }

    public function getTableGateway(string $name): TableGateway
    {
        return $this->tableGatewayCollection->offsetGet($name);
    }
}
