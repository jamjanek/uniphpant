<?php

use Phinx\Migration\AbstractMigration;

class CreateBlockContentTable extends AbstractMigration
{
    
    const TABLE_NAME = "block_content";

    public function up()
    {
        $this->dropTable(self::TABLE_NAME);
    }

    public function change()
    {
        $table = $this->table(self::TABLE_NAME, ['id' => false]);
        $table->addColumn('block_uid', 'string', ['limit' => 64])
            ->addColumn('content_uid', 'string', ['limit' => 64,'null' => true])
            ->addColumn('attributes', 'string',['default' => '{}'])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('order', 'integer', ['limit' => 8])
            ->addColumn('comm', 'string', ['null' => true])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}