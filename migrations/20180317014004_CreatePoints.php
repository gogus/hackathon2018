<?php

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use Phpmig\Migration\Migration;

class CreatePoints extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $schemaBuilder = $this->getSchemaBuilder();
        $schemaBuilder->dropIfExists('points');
        $schemaBuilder->create('points', function (Blueprint $table) {
            $table->uuid('user_id');
            $table->integer('points', 12);

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
        $this->getSchemaBuilder()->drop('points');
    }

    /**
     * @return Builder
     */
    protected function getSchemaBuilder()
    {
        /** @var Manager $db */
        $db = $this->get('db');

        return $db->getDatabaseManager()->getSchemaBuilder();
    }

}
