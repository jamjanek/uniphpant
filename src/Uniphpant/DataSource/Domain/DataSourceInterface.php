<?php
declare(strict_types=1);

namespace App\Uniphpant\DataSource\Domain;

interface DataSourceInterface
{
    public function create();
    public function getDataSource();
}
