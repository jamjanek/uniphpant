<?php

use Phinx\Seed\AbstractSeed;

class AreaBlockSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'area_uid' => 'e1befef2-bc2c-40b1-ad87-d426615fc648',
                'block_uid' => 'fdaf870a-8bfe-4867-b69a-b31d92c4fef6',
                'attributes' => '{}',
                'status' => 1,
                'comm' => null,
                'order' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('area_block');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
