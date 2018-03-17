<?php

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use Phpmig\Migration\Migration;


class CreatePassenger extends Migration
{
    public function up()
    {
        $schemaBuilder = $this->getSchemaBuilder();
        $schemaBuilder->dropIfExists('passenger');
        $schemaBuilder->create('passenger', function (Blueprint $table) {
            $table->string('trip_id', 100);
            $table->string('passenger', 100);
 
            $table->primary('trip_id', 'passenger');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    public function down()
    {
        $this->getSchemaBuilder()->drop('passenger');
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
