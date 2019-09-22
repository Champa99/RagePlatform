<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CoreUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		$avatar = 'https://i.pinimg.com/originals/2c/c1/00/2cc100a3ba1331030858454a59eb63a8.jpg';

		$q = "INSERT INTO core_users (username, email, password, avatar, date_registered, user_group, pin_code, not_count, mess_count)
			VALUES (:username, :email, :password, :avatar, UNIX_TIMESTAMP(), 1, 1234, 0, 0)";

		DB::insert($q, [
			'username'	=>	'admin',
			'email'		=>	'admin@admin.com',
			'password'	=>	Hash::make('admin'),
			'avatar'	=>	$avatar
		]);
	}
	
	public function createTestAdminAcc() {

		
	}
}
