<?php
declare(strict_types=1);

namespace App\Uniphpant\TableGateway\Service;

use Zend\Db\TableGateway\TableGateway;
use ArrayObject;

/**
 * Class TableGatewayService
 * @package App\Uniphpant\TableGateway
 */
class TableGatewayService
{
    protected $tableGatewayCollection;

    public function __construct(ArrayObject $tableGatewayCollection)
    {
        $this->tableGatewayCollection = $tableGatewayCollection;
    }

    public function getTableGateway(string $name): TableGateway
    {
        return $this->tableGatewayCollection->offsetGet($name);
    }
}
