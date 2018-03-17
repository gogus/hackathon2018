<?php

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use Phpmig\Migration\Migration;


class CreateUserCar extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $schemaBuilder = $this->getSchemaBuilder();
        $schemaBuilder->dropIfExists('car');
        $schemaBuilder->create('car', function (Blueprint $table) {
            $table->uuid('user_id');
            $table->boolean('have_car');
            $table->integer('available_seats',2);

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
        $this->getSchemaBuilder()->drop('car');
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
