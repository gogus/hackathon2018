<?php

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\DatabaseManager;
use Phpmig\Migration\Migration;

class InsertInitialUsers extends Migration
{
    public function up()
    {
        $this->getDatabaseManager()->table('user')->insert([
            [
                'id' => '725a7f14-ed1a-45e2-b82c-24736c673429',
                'username' => 'mike',
                'password' => 'mike',
                'first_name' => 'Ionut-Mihai',
                'last_name' => 'Sandu'
            ],
            [
                'id' => '2929d8a4-7c3a-4fbc-a564-126aece71447',
                'username' => 'miki',
                'password' => 'miki',
                'first_name' => 'Mikolaj',
                'last_name' => 'Gogula'
            ],
            [
                'id' => 'e1346b39-671c-4f46-93e6-41b70a482594',
                'username' => 'pribi',
                'password' => 'pribi',
                'first_name' => 'Bruce',
                'last_name' => 'Willis'
            ],
            [
                'id' => '221d67d2-04dc-4993-a243-591661ad8642',
                'username' => 'yuri',
                'password' => 'yuri',
                'first_name' => 'Yuri',
                'last_name' => 'Golikov'
            ],
        ]);
    }

    public function down()
    {
        $user = $this->getDatabaseManager()->table('user');

        $user->delete('725a7f14-ed1a-45e2-b82c-24736c673429');
        $user->delete('2929d8a4-7c3a-4fbc-a564-126aece71447');
        $user->delete('e1346b39-671c-4f46-93e6-41b70a482594');
        $user->delete('221d67d2-04dc-4993-a243-591661ad8642');
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
