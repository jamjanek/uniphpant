<?php

use Phinx\Seed\AbstractSeed;

class BlockContentSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'block_uid' => 'fdaf870a-8bfe-4867-b69a-b31d92c4fef6',
                'content_uid' => '3241e77a-6e0d-4967-a271-8a7c932963b4',
                'attributes' => '{}',
                'status' => 1,
                'comm' => null,
                'order' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('block_content');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
