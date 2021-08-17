<?php


use Phinx\Migration\AbstractMigration;

class CreateInputFilterSpecTable extends AbstractMigration
{

    const TABLE_NAME = "input_filter_spec";
    
    public function up()
    {
        $this->dropTable(self::TABLE_NAME);
    }

    public function change()
    {
        $table = $this->table(self::TABLE_NAME, ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('type',  'string', ['limit' => 64])
            ->addColumn('page_cache', 'integer', ['limit' => 1,'default' => 0])
            ->addColumn('page_layout', 'string', ['null' => true])
            ->addColumn('language', 'string', ['limit' => 16,'default' => 'en_en'])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('comm', 'string', ['null' => true])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
