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
                'route_name' => 'request',
                'methods' => 'get',
                'status' => 1,
                'comm' => null,
                'created' => date('Y-m-d H:i:s'),
            ],
//            [
//                'uid' => '911ef575-430d-42f3-a27a-08c12c59e459',
//                'route_name' => 'not_found',
//                'methods' => 'Error 404: age not found.',
//                'status' => 1,
//                'comm' => null,
//                'created' => date('Y-m-d H:i:s'),
//            ],
        ];

        $table = $this->table(self::TABLE_NAME);
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
