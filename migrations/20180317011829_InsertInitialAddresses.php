<?php

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\DatabaseManager;
use Phpmig\Migration\Migration;

class InsertInitialAddresses extends Migration
{
    public function up()
    {
        $this->getDatabaseManager()->table('address')->insert([
            [
                'user_id' => '725a7f14-ed1a-45e2-b82c-24736c673429',
                'home_address' => 'Eurener Straße, Trier, Germany',
                'work_address' => '44 Avenue John F. Kennedy, Luxembourg',
                'home_geo_lat' => '49.7468052',
                'home_geo_long' => '6.6143054',
                'work_geo_lat' => '49.6318168',
                'work_geo_long' => '6.1692465'
            ],
            [
                'user_id' => '2929d8a4-7c3a-4fbc-a564-126aece71447',
                'home_address' => "Route d'Arlon, Luxembourg",
                'work_address' => '44 Avenue John F. Kennedy, Luxembourg',
                'home_geo_lat' => '49.6365498',
                'home_geo_long' => '6.0097661',
                'work_geo_lat' => '49.6318168',
                'work_geo_long' => '6.1692465'
            ],
            [
                'user_id' => 'e1346b39-671c-4f46-93e6-41b70a482594',
                'home_address' => 'Luxemburger Straße, Trier, Germany',
                'work_address' => '44 Avenue John F. Kennedy, Luxembourg',
                'home_geo_lat' => '49.7353504',
                'home_geo_long' => '6.6091798',
                'work_geo_lat' => '49.6318168',
                'work_geo_long' => '6.1692465'
            ],
            [
                'user_id' => '221d67d2-04dc-4993-a243-591661ad8642',
                'home_address' => 'Luxembourg Central Station, Luxembourg City, Luxembourg',
                'work_address' => '44 Avenue John F. Kennedy, Luxembourg',
                'home_geo_lat' => '49.6008197',
                'home_geo_long' => '6.130916',
                'work_geo_lat' => '49.6318168',
                'work_geo_long' => '6.1692465'
            ],
        ]);
    }

    public function down()
    {
        $user = $this->getDatabaseManager()->table('address');

        $user->table('address')->delete('725a7f14-ed1a-45e2-b82c-24736c673429');
        $user->table('address')->delete('2929d8a4-7c3a-4fbc-a564-126aece71447');
        $user->table('address')->delete('e1346b39-671c-4f46-93e6-41b70a482594');
        $user->table('address')->delete('221d67d2-04dc-4993-a243-591661ad8642');
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
