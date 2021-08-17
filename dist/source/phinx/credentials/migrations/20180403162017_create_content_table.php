<?php


use Phinx\Migration\AbstractMigration;

class CreateContentTable extends AbstractMigration
{

    const TABLE_NAME = "content";
    
    public function up()
    {
        $this->dropTable(self::TABLE_NAME);
    }

    public function change()
    {
        $table = $this->table(self::TABLE_NAME, ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('type', 'string')
            ->addColumn('content', 'string')
            ->addColumn('attributes', 'string',['default' => '{}'])
            ->addColumn('parameters', 'string',['default' => '{}'])
            ->addColumn('options', 'string',['default' => '{}'])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('order', 'string', ['limit' => 8])
            ->addColumn('comm', 'string', ['null' => true])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
