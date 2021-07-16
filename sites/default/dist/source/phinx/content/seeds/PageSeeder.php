<?php

use Phinx\Seed\AbstractSeed;

class PageSeeder extends AbstractSeed
{
    const TABLE_NAME = "page";

    public function run()
    {
        $data = [
            [
                'uid' => 'e77309ce-a0c1-48dd-800c-d38c8d3fa6c3',
                'route_uid' => '520994f4-b62f-4a96-aceb-bbdd1d0ae2c6',
                'methods' => 'get',
                'status' => 1,
                'comm' => "Homepage One.",
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => '438e57df-d619-48a1-8f60-e579832a3c41',
                'route_uid' => '520994f4-b62f-4a96-aceb-bbdd1d0ae2c6',
                'methods' => 'get',
                'status' => 1,
                'comm' => "Homepage Two.",
                'created' => date('Y-m-d H:i:s'),
            ],
//            [
//                'uid' => '28309764-e4f8-4c87-94c9-1691c7169215',
//                'route_uid' => '911ef575-430d-42f3-a27a-08c12c59e459',
//                'methods' => 'get',
//                'status' => 1,
//                'comm' => "Error 404.",
//                'created' => date('Y-m-d H:i:s'),
//            ],
        ];

        $table = $this->table(self::TABLE_NAME);
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
