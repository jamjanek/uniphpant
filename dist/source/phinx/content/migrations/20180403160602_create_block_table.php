<?php


use Phinx\Migration\AbstractMigration;

class CreateBlockTable extends AbstractMigration
{
    
    const TABLE_NAME = "block";

    public function up()
    {
        $this->dropTable(self::TABLE_NAME);
    }

    public function change()
    {
        $table = $this->table(self::TABLE_NAME, ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('content', 'string',['null' => true,'default' => null])
            ->addColumn('attributes', 'string',['default' => '{}'])
            ->addColumn('parameters', 'string',['default' => '{}'])
            ->addColumn('options', 'string',['default' => '{}'])
            ->addColumn('comm', 'string', ['null' => true])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('order', 'integer', ['limit' => 8])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
