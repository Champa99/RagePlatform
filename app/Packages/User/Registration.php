<?php

/**
 * Auto created by artisan on 30.07.2019 at 18:10
 * @author Champa
 */

namespace App\Packages\User;

use DB;
use Hash;
use Avatar;

class Registration
{
	/**
	 * @var string
	 */
	private $username;

	/**
	 * @var string
	 */
	private $email;

	/**
	 * @var string
	 */
	private $password;

	/**
	 * @var int
	 */
	private $status = 0;

	public function attempt() {

		$this->checkForAccount();

		if($this->status == 0) {
			
			Avatar::create($this->username)->save(public_path('platformStorage/avatars/'. $this->username .'.png'), 90);

			$q = "INSERT INTO core_users (username, email, password, avatar, date_registered) VALUES
				(:username, :email, :password, :avatar, :date_registered)";

			DB::insert($q, [
				'username'			=>	$this->username,
				'email'				=>	$this->email,
				'password'			=>	Hash::make($this->password),
				'avatar'			=>	'platformStorage/avatars/'. $this->username .'.png',
				'date_registered'	=>	time()
			]);
		}
	}

	private function checkForAccount() : void {

		$q = "SELECT username, email FROM core_users WHERE username = :username OR email = :email LIMIT 1";
		$data = DB::select($q, [
			'username'	=>	$this->username,
			'email'		=>	$this->email
		]);

		if(isset($data[0]) && !empty($data[0])) {

			if($data[0]->username == $this->username) {

				$this->status = 10;

				return;
			}

			if($data[0]->email == $this->email) {

				$this->status = 11;

				return ;
			}
		}
	}

	/**
	 * Set the value of username
	 *
	 * @param   string  $username  
	 *
	 * @return  self
	 */
	public function setUsername(?string $username) {

		$this->username = $username;

		return $this;
	}

	/**
	 * Set the value of email
	 *
	 * @param   string  $email  
	 *
	 * @return  self
	 */
	public function setEmail(?string $email) {

		$this->email = $email;

		return $this;
	}

	/**
	 * Set the value of password
	 *
	 * @param   string  $password  
	 *
	 * @return  self
	 */
	public function setPassword(?string $password) {

		$this->password = $password;

		return $this;
	}

	/**
	 * Get the value of status
	 *
	 * @return  int
	 */
	public function getStatus() : ?int {

		return $this->status;
	}
}