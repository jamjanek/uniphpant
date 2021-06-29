<?php

use Phinx\Seed\AbstractSeed;

class RouteSeeder extends AbstractSeed
{
    const TABLE_NAME = "route";

    public function run()
    {
        $data = [

            [
                'uid' => '520994f4-b62f-4a96-aceb-bbdd1d0ae2c6',
                'route_name' => 'homepage',
                'methods' => 'Hello World!',
                'status' => 1,
                'comm' => null,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table(self::TABLE_NAME);
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
