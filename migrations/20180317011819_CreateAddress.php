<?php

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use Phpmig\Migration\Migration;

class CreateAddress extends Migration
{
    public function up()
    {
        $schemaBuilder = $this->getSchemaBuilder();
        $schemaBuilder->dropIfExists('address');
        $schemaBuilder->create('address', function (Blueprint $table) {
            $table->uuid('user_id');
            $table->string('home_address', 200);
            $table->string('work_address', 200);
            $table->string('home_geo_lat', 100);
            $table->string('home_geo_long', 100);
            $table->string('work_geo_lat', 100);
            $table->string('work_geo_long', 100);

            $table->primary('user_id');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    public function down()
    {
        $this->getSchemaBuilder()->drop('address');
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
