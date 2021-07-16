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
                'template_uid' => '75378dea-6549-4f22-928c-84febfbd0bb1',
                'attributes' => '{}',
                'status' => 1,
                'comm' => 'Common Seo tags',
                'order' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'e1befef2-bc2c-40b1-ad87-d426615fc648',
                'section' => 'main',
                'template_uid' => '75378dea-6549-4f22-928c-84febfbd0bb1',
                'attributes' => '{}',
                'status' => 1,
                'comm' => 'Main Area',
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
