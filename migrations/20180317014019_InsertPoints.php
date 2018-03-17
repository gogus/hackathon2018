<?php

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\DatabaseManager;
use Phpmig\Migration\Migration;

class InsertPoints extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {

        $this->getDatabaseManager()->table('points')->insert([
            [
                'user_id' => '725a7f14-ed1a-45e2-b82c-24736c673429',
                'points' => 28
            ],
            [
                'user_id' => '2929d8a4-7c3a-4fbc-a564-126aece71447',
                'points' => 5
            ],
            [
                'user_id' => 'e1346b39-671c-4f46-93e6-41b70a482594',
                'points' => 10
            ],
            [
                'user_id' => '221d67d2-04dc-4993-a243-591661ad8642',
                'points' => 15
            ],
        ]);

    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $db = $this->getDatabaseManager();
        $db->table('points')->where('user_id', '=','725a7f14-ed1a-45e2-b82c-24736c673429')->delete();
        $db->table('points')->where('user_id', '=','2929d8a4-7c3a-4fbc-a564-126aece71447')->delete();
        $db->table('points')->where('user_id', '=','e1346b39-671c-4f46-93e6-41b70a482594')->delete();
        $db->table('points')->where('user_id', '=','221d67d2-04dc-4993-a243-591661ad8642')->delete();
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
