<?php

/**
 * Auto created by artisan on 31.07.2019 at 12:44
 * @author Champa
 */

namespace App\Packages\User;

use Cache;
use DB;
use Hash;
use App\Packages\System\CacheVisor;
use App\Packages\ResponseBuilder\Codes;

class Login
{
	/**
	 * @var string
	 */
	private $userLogOn;

	/**
	 * @var string
	 */
	private $password;

	/**
	 * @var int
	 */
	private $status = 0;

	/**
	 * @var int
	 */
	private $userId = 0;

	/**
	 * Attempts to log a user
	 */
	public function attempt() : void {

		$q = "SELECT id, password FROM core_users WHERE username = :username OR email = :email LIMIT 1";
		$data = DB::select($q, [
			'username'	=>	$this->userLogOn,
			'email'		=>	$this->userLogOn	
		]);

		if(!isset($data[0]) || empty($data[0])) {

			$this->status = Codes::NO_ACCOUNT;

			return;
		}

		if (!Hash::check($this->password, $data[0]->password)) {
			
			$this->status = Codes::WRONG_PASSWORD;

			return;
		}

		$this->userId = $data[0]->id;
	}

	/**
	 * Set the value of userlogOn
	 *
	 * @param   string  $userlogOn  
	 *
	 * @return  self
	 */
	public function setUserLogOn(?string $setUserLogOn) {

		$this->userLogOn = $setUserLogOn;

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

	/**
	 * Get the value of userId
	 *
	 * @return  int
	 */
	public function getUserId() : ?int {

		return $this->userId;
	}
}