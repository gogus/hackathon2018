<?php

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\DatabaseManager;
use Phpmig\Migration\Migration;

class InsertUserCar extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {

        $this->getDatabaseManager()->table('car')->insert([
            [
                'user_id' => '725a7f14-ed1a-45e2-b82c-24736c673429',
                'have_car' => true,
                'available_seats' => 3,
            ],
            [
                'user_id' => '221d67d2-04dc-4993-a243-591661ad8642',
                'have_car' => true,
                'available_seats' => 1,
            ],
        ]);

    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $db = $this->getDatabaseManager();
        $db->table('car')->where('user_id', '=','725a7f14-ed1a-45e2-b82c-24736c673429')->delete();
        $db->table('car')->where('user_id', '=','221d67d2-04dc-4993-a243-591661ad8642')->delete();
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
