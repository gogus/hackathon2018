<?php

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Schema\Blueprint;
use Phpmig\Migration\Migration;

class RenameUsernameToEmail extends Migration
{
    public function up()
    {
        $dm = $this->getDatabaseManager();
        $dm->getSchemaBuilder()->table('user', function (Blueprint $table) {
            $table->renameColumn('username', 'email');
        });
        $dm->table('user')->where('id', '=', '725a7f14-ed1a-45e2-b82c-24736c673429')->update(['email' => 'mike@gtw.lu']);
        $dm->table('user')->where('id', '=', '2929d8a4-7c3a-4fbc-a564-126aece71447')->update(['email' => 'miki@gtw.lu']);
        $dm->table('user')->where('id', '=', 'e1346b39-671c-4f46-93e6-41b70a482594')->update(['email' => 'pribi@gtw.lu']);
        $dm->table('user')->where('id', '=', '221d67d2-04dc-4993-a243-591661ad8642')->update(['email' => 'yuri@gtw.lu']);
    }

    public function down()
    {
        $dm = $this->getDatabaseManager();
        $dm->table('user')->where('id', '=', '725a7f14-ed1a-45e2-b82c-24736c673429')->update(['email' => 'mike']);
        $dm->table('user')->where('id', '=', '2929d8a4-7c3a-4fbc-a564-126aece71447')->update(['email' => 'miki']);
        $dm->table('user')->where('id', '=', 'e1346b39-671c-4f46-93e6-41b70a482594')->update(['email' => 'pribi']);
        $dm->table('user')->where('id', '=', '221d67d2-04dc-4993-a243-591661ad8642')->update(['email' => 'yuri']);
        $dm->getSchemaBuilder()->table('user', function (Blueprint $table) {
            $table->renameColumn('email', 'username');
        });
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
