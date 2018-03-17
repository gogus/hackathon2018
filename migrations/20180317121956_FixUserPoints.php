<?php

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Schema\Blueprint;
use Phpmig\Migration\Migration;

class FixUserPoints extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $schemaBuilder = $this->getDatabaseManager()->getSchemaBuilder();
        $schemaBuilder->table('points', function (Blueprint $table) {
            $table->integer('points')->change();
            $table->dropPrimary();
            $table->primary('user_id');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $schemaBuilder = $this->getDatabaseManager()->getSchemaBuilder();
        $schemaBuilder->drop('points');
        $schemaBuilder->create('points', function (Blueprint $table) {
            $table->uuid('user_id');
            $table->integer('points', 12);

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
        $points = [];
        $users = $this->getDatabaseManager()->table('user')->get()->all();
        foreach ($users as $user) {
            $points[] = [
                'user_id' => $user->id,
                'points' => 0
            ];
        }

        $this->getDatabaseManager()->table('points')->insert($points);
    }

    /**
     * @return DatabaseManager
     */
    protected function getDatabaseManager()
    {
        /** @var Manager $db */
        $db = $this->get('db');

        return $db->getDatabaseManager();
    }
}
