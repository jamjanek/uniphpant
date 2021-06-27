<?php

use Phinx\Seed\AbstractSeed;

class AreaSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid' => 'area-000',
                'section' => 'head-meta',
                'attributes' => '{}',
                'status' => 1,
                'comm' => 'Common Seo tags',
                'order' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'area-001',
                'section' => 'nav',
                'attributes' => '{}',
                'status' => 1,
                'comm' => 'Navigation Area',
                'order' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'area-002',
                'section' => 'main',
                'attributes' => '{}',
                'status' => 1,
                'comm' => 'Content Area',
                'order' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'area-010',
                'section' => 'footer-scripts',
                'attributes' => '{}',
                'status' => 1,
                'comm' => 'Common Footer Scripts',
                'order' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('area');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
