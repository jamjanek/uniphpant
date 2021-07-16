<?php

use Phinx\Seed\AbstractSeed;

class BlockSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [

            [
                'uid' => 'fdaf870a-8bfe-4867-b69a-b31d92c4fef6',
                'content' => null,
                'attributes' => '{}',
                'parameters' => '{"html_tag":"div"}',
                'comm' => 'header wrapper',
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
