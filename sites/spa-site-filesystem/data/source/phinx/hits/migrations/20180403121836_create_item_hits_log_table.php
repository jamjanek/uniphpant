<?php


use Phinx\Migration\AbstractMigration;

class CreateItemHitsLogTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('item_hits_log');
    }

    public function change()
    {
        $table = $this->table('item_hits_log', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('app_uid', 'string', ['limit' => 64], ['null' => true])
            ->addColumn('hits', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
