<?php


use Phinx\Seed\AbstractSeed;

class TemplateSeeder extends AbstractSeed
{
    const TABLE_NAME = "template";

    public function run()
    {
        $data = [
            [
                'uid' => '75378dea-6549-4f22-928c-84febfbd0bb1',
                'route_uid' => '520994f4-b62f-4a96-aceb-bbdd1d0ae2c6',
                'type' => 'filesystem',
                'location' => 'default',
                'name' => 'page-default',
                'label' => 'Template #1',
                'comm' => 'Template #1',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => '68e9b2f8-bd6e-4a65-9f0c-ab5481b402c6',
                'route_uid' => '520994f4-b62f-4a96-aceb-bbdd1d0ae2c6',
                'type' => 'filesystem',
                'location' => 'Template #2',
                'name' => 'page-default',
                'label' => 'Template #2',
                'comm' => 'Template #2',
                'status' => 0,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table(self::TABLE_NAME);
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
