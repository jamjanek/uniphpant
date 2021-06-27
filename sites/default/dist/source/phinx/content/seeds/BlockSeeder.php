<?php

use Phinx\Seed\AbstractSeed;

class BlockSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [

            [
                'uid' => 'block-001',
                'content' => null,
                'attributes' => '{}',
                'parameters' => '{"html_tag":"div"}',
                'comm' => 'header for tv',
                'status' => 0,
                'order' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('block');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
