<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoreConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $q = "INSERT INTO `core_config` (`key`, `value`) VALUES
        ('hash_salt', 'PWtu2X0Gpx8RR43mD5HS'),
        ('site_name', 'RAGE Development'),
        ('theme', 'default');";

        DB::insert($q);

        $q = "INSERT INTO `core_groups` (`id`, `name`, `description`) VALUES
        (1, 'Admin', 'Main admin group');";

        DB::insert($q);

        $q = "INSERT INTO `core_group_permissions` (group_id, perm_group, perm) VALUES
        (1, 1, 1)";

        DB::insert($q);

        $q = "ALTER TABLE `core_users` CHANGE `user_group` `user_group` SMALLINT(6) NOT NULL DEFAULT '1';";

        DB::query($q);
    }
}
