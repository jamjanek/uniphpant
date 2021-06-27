<?php

use Phinx\Migration\AbstractMigration;

class CreatePageTable extends AbstractMigration
{

    const TABLE_NAME = "page";
    
    public function up()
    {
        $this->dropTable(self::TABLE_NAME);
    }

    public function change()
    {
        $table = $this->table(self::TABLE_NAME, ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('methods',  'string', ['limit' => 64,'default' => '{}'])
            ->addColumn('route_uid',  'string', ['limit' => 64])
            ->addColumn('template_uid', 'string', ['limit' => 64])
            ->addColumn('page_name', 'string', ['limit' => 255])
            ->addColumn('route_url', 'string')
            ->addColumn('page_cache', 'integer', ['limit' => 1,'default' => 0])
            ->addColumn('page_layout', 'string', ['null' => true])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('comm', 'string', ['null' => true])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
