<?php
declare(strict_types=1);

namespace App\Uniphpant\DataSource\Domain;

class DataSourceEntity
{
    protected $name;
    protected $site_id;
    protected $type;
    protected $driver;
    protected $database;

    public function __construct(string $name, string $site_id, string $type, string $driver, string $database)
    {
        $this->name = $name;
        $this->site_id = $site_id;
        $this->type = $type;
        $this->driver = $driver;
        $this->database = $database;
    }
}
