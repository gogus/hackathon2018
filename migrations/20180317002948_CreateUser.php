<?php

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use Phpmig\Migration\Migration;

class CreateUser extends Migration
{
    public function up()
    {
        $schemaBuilder = $this->getSchemaBuilder();
        $schemaBuilder->dropIfExists('user');
        $schemaBuilder->create('user', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('username', 100);
            $table->string('password', 100);
            $table->string('first_name', 100);
            $table->string('last_name', 100);

            $table->primary('id');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    public function down()
    {
        $this->getSchemaBuilder()->drop('user');
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
