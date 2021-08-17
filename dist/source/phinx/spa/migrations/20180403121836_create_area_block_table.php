<?php

use Phinx\Migration\AbstractMigration;

class CreateAreaBlockTable extends AbstractMigration
{
    
    const TABLE_NAME = "area_block";

    public function up()
    {
        $this->dropTable(self::TABLE_NAME);
    }

    public function change()
    {
        $table = $this->table(self::TABLE_NAME, ['id' => false]);
        $table->addColumn('area_uid', 'string', ['limit' => 64])
            ->addColumn('block_uid', 'string', ['limit' => 64,'null' => true])
            ->addColumn('attributes', 'string',['default' => '{}'])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('order', 'integer', ['limit' => 8])
            ->addColumn('comm', 'string', ['null' => true])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
