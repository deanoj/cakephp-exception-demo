<?php
use Migrations\AbstractMigration;

class CreateConfigs extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('configs');
        $table->addColumn('config_key', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('config_value', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'null' => false])
            ->addIndex(['config_key']);
        $table->create();
    }
}
