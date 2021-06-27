<?php

use Phinx\Seed\AbstractSeed;

class ContentSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [

            [
                'uid' => 'content-001',
                'type' => 'text',
                'content' => 'Hello World!',
                'attributes' => '{}',
                'parameters' => '{"html_tag":"h1"}',
                'options' => '{}',
                'status' => 1,
                'order' => 1,
                'comm' => null,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('content');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
