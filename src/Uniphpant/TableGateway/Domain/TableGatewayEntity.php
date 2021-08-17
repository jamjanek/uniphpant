<?php
declare(strict_types=1);

namespace App\Uniphpant\TableGateway\Domain;

class TableGatewayEntity
{
    protected $name;
    protected $table_name;
    protected $data_source;

    public function __construct(string $name,string $table_name,string $data_source)
    {
        $this->name = $name;
        $this->table_name = $table_name;
        $this->data_source = $data_source;
    }
}
