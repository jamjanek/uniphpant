<?php


use Phinx\Migration\AbstractMigration;

class CreateAreaTable extends AbstractMigration
{
    
    const TABLE_NAME = "area";

    public function up()
    {
        $this->dropTable(self::TABLE_NAME);
    }

    public function change()
    {
        $table = $this->table(self::TABLE_NAME, ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('section', 'string', ['limit' => 64], ['null' => true])
            ->addColumn('attributes', 'string',['default' => '{}'])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('order', 'integer', ['limit' => 8])
            ->addColumn('comm', 'string')
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
