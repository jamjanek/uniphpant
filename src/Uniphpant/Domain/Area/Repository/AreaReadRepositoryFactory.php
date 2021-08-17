<?php
declare(strict_types=1);

namespace App\Uniphpant\Domain\Area\Repository;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;

class AreaReadRepositoryFactory
{
    /**
     * @var QueryFactory The query builder factory
     */
    private $queryFactory;

    /**
     * @var AdapterInterface The database connection
     */
    private $adapter;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function table(string $table): TableGateway
    {
        return new TableGateway(
            $table,
            $this->adapter,
            null,
            new ResultSet(ResultSet::TYPE_ARRAY)
        );
    }

}