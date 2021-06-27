<?php

use Phinx\Migration\AbstractMigration;

class CreateSeoTable extends AbstractMigration
{

    const TABLE_NAME = "seo";
    
    public function up()
    {
        $this->dropTable(self::TABLE_NAME);
    }

    public function change()
    {
        $table = $this->table(self::TABLE_NAME, ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('type',  'string', ['limit' => 64])
            ->addColumn('content', 'string')
            ->addColumn('attributes', 'string', ['default' => '{}'])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('comm', 'string', ['null' => true])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
