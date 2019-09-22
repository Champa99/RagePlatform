<?php

/**
 * Auto created by artisan on 29.07.2019 at 14:01
 * @author Champa
 */

namespace App\Packages\User;

use Cache;
use DB;
use App\Packages\System\CacheVisor;

class Session
{
	/**
	 * @var string
	 */
	private $token;

	/**
	 * @var string
	 */
	private $id;

	/**
	 * Creates a new session object
	 */
	public function __construct(string $token) {

		$this->token = $token;
		$this->id = self::hashToken($token);
	}

	public function getUserId() : ?int {

		$key = 'usrIdSes_'. $this->id;
		$cache = Cache::remember($key, CacheVisor::time('MINOR'), function() {

			$q = "SELECT core_users.id FROM core_users INNER JOIN core_sessions ON core_users.id = core_sessions.user_id
			WHERE core_sessions.id = :session_id LIMIT 1";

			return DB::select($q, [
				'session_id' =>	$this->id
			]);
		});

		if(isset($cache[0]) && !empty($cache[0])) {

			return $cache[0]->id;
		}
	}

	/**
	 * Checks if the session is valid
	 */
	public function isValid() : bool {

		if($this->id != null) {

			$q = "SELECT browser, browser_ver, ip FROM core_sessions WHERE id = :id LIMIT 1";

			$data = DB::select($q, [
				'id'	=>	$this->id
			]);

			// Check if the session even exists
			if(isset($data[0]) && !empty($data)) {

				$browser = getBrowser();
				$ip = getIp();
				$session = $data[0];

				// Make sure there isn't any forgery
				if($session->browser == $browser['name'] && $session->browser_ver == $browser['version'] && $session->ip == $ip) {

					// If everything is good
					return true;
				}
			}
		}

		// Houston, we have a problem..
		return false;
	}

	/**
	 * Creates a user session and returns a token whose hash is the session ID
	 */
	public static function create(int $userId, bool $persistant = false) : string {

		$q = "INSERT INTO core_sessions (id, user_id, created, expires, agent, os, browser, browser_ver, ip) VALUES
		(:id, :user_id, :created, :expires, :agent, :os, :browser, :browser_ver, :ip)";

		$session = self::generateId();
		$browser = getBrowser();

		$time = time();
		$expiry = ($persistant ? 31557600 : 86400);

		DB::insert($q, [
			'id'			=>	$session['id'],
			'user_id'		=>	$userId,
			'created'		=>	$time,
			'expires'		=>	($time + $expiry),
			'agent'			=>	$browser['userAgent'],
			'os'			=>	getOS(),
			'browser'		=>	$browser['name'],
			'browser_ver'	=>	$browser['version'],
			'ip'			=>	getIp()
		]);

		return $session['token'];
	}

	/**
	 * Returns a hashed version of the token (the session ID)
	 */
	public static function hashToken(string $token) : string {

		return hash('sha256', rageConfig('hash_salt') . $token);
	}

	/**
	 * Generates a new session id
	 * 
	 * @return array - hashed session id and the plain one
	 */
	protected static function generateId() : array {

		$cstrong = true;
		$time = time();
		$lastNum = ($time % 10000) * rand(1, 99);
		$bytes = openssl_random_pseudo_bytes(15, $cstrong);

		$key = str_random(30) . (int) ($time / 10000 + rand(1000, 3000)) . str_random(15) .'111'. str_random(60) . $lastNum . bin2hex($bytes);

		return [
			'token'	=>	$key,
			'id'	=>	self::hashToken($key)
		];
	}

	/**
	 * Get the value of token
	 *
	 * @return  string
	 */
	public function getToken() : ?string {

		return $this->token;
	}

	/**
	 * Get the value of id
	 *
	 * @return  string
	 */
	public function getId() : ?string {

		return $this->id;
	}
}