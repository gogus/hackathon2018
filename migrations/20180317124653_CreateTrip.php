<?php

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use Phpmig\Migration\Migration;

class CreateTrip extends Migration
{
    public function up()
    {
        $schemaBuilder = $this->getSchemaBuilder();
        $schemaBuilder->dropIfExists('trip');
        $schemaBuilder->create('trip', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('driver', 100);
            $table->time('start_time');
            $table->string('start_address', 200);
            $table->string('destination_address', 200);
            $table->string('start_geo_lat', 100);
            $table->string('start_geo_long', 100);
            $table->string('destination_geo_lat', 100);
            $table->string('destination_geo_long', 100);
            $table->integer('available_seats');

            $table->primary('id');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    public function down()
    {
        $this->getSchemaBuilder()->drop('trip');
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
