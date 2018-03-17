<?php

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use Phpmig\Migration\Migration;


class CreateSchedule extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $schemaBuilder = $this->getSchemaBuilder();
        $schemaBuilder->dropIfExists('schedule');
        $schemaBuilder->create('schedule', function (Blueprint $table) {
            $table->uuid('user_id');
            $table->boolean('flex_h');
            $table->integer('flex_interval',2);
            $table->time('schedule_interval_start');
            $table->time('schedule_interval_end');

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
        $this->getSchemaBuilder()->drop('schedule');
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
