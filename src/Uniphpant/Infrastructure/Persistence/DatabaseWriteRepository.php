<?php
declare(strict_types=1);

namespace App\Shrt\Infrastructure\Persistence\Shrt;

use App\Shrt\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Shrt\Domain\ShrtRepository;
use App\Uniphpant\DataSource\Domain\DataSourceInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;

class DatabaseRepository implements ShrtRepository
{
    /**
     * @var User[]
     */
    private $tableGateway;

    /**
     * InMemoryUserRepository constructor.
     *
     * @param array|null $users
     */
    public function __construct(DataSourceInterface $data_source)
    {
        $dbAdapterConfig = [
            'type' => 'db_adapter',
            'driver'   => 'Pdo_Sqlite',
            'database' =>  realpath(__DIR__ . '/../../../../../data/database/shrt-xdd.sqlite3'),
        ];
        $dbAdapter = new Adapter($dbAdapterConfig);
        $this->tableGateway = new TableGateway('item',$dbAdapter);

    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        return array_values($this->users);
    }

    public function getById($id): AreaEntity
    {
        return AreaEntity::fromState(
            $this->tableGateway->findOne(
                $this->tableName,
                [
                    'id' => $id
                ]
            );
    );
    }


    /**
     * {@inheritdoc}
     */
    public function findUserOfId(int $id): User
    {
        if (!isset($this->users[$id])) {
            throw new UserNotFoundException();
        }

        return $this->users[$id];
    }
    public function selectByUid(string $uid)
    {
        return $this->tableGateway->select(['uid'=>$uid]);
    }

    public function insert(?string $url,?string $uid)
    {
        if($uid===null) {
            $uuidGen = new \App\Shrt\Domain\Uuid();
            $uid = $uuidGen->generateUuid();
        }

        $this->tableGateway->insert([
            'uid'=>$uid,
            'url'=>$url,
            'status'=>1,
            'created'=>date('Y-m-d H:i:s')
        ]);

        return $uid;
    }
}
