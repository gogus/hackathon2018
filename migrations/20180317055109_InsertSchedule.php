<?php

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\DatabaseManager;
use Phpmig\Migration\Migration;


class InsertSchedule extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->getDatabaseManager()->table('schedule')->insert([
            [
                'user_id' => '725a7f14-ed1a-45e2-b82c-24736c673429',
                'flex_h' => false,
                'flex_interval' => 0,
                'schedule_interval_start' => '09:00',
                'schedule_interval_end' => '18:00',
            ],
            [
                'user_id' => '2929d8a4-7c3a-4fbc-a564-126aece71447',
                'flex_h' => true,
                'flex_interval' => 1,
                'schedule_interval_start' => '08:00',
                'schedule_interval_end' => '17:00',
            ],
            [
                'user_id' => 'e1346b39-671c-4f46-93e6-41b70a482594',
                'flex_h' => true,
                'flex_interval' => 1,
                'schedule_interval_start' => '09:00',
                'schedule_interval_end' => '18:00',
            ],
            [
                'user_id' => '221d67d2-04dc-4993-a243-591661ad8642',
                'flex_h' => true,
                'flex_interval' => 1,
                'schedule_interval_start' => '07:30',
                'schedule_interval_end' => '17:30',
            ],
        ]);
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $user = $this->getDatabaseManager();
        $user->table('schedule')->delete('725a7f14-ed1a-45e2-b82c-24736c673429');
        $user->table('schedule')->delete('2929d8a4-7c3a-4fbc-a564-126aece71447');
        $user->table('schedule')->delete('e1346b39-671c-4f46-93e6-41b70a482594');
        $user->table('schedule')->delete('221d67d2-04dc-4993-a243-591661ad8642');
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
