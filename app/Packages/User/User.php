<?php

/**
 * Auto created by artisan on 29.07.2019 at 00:03
 * @author Champa
 */

namespace App\Packages\User;

use Cache;
use DB;
use App\Packages\System\CacheVisor;
use App\Packages\User\Session;

class User
{
	/**
	 * @var object
	 */
	private $info = null;

	/**
	 * @var App\Packages\User\Session
	 */
	private $session = null;

	/**
	 * @var App\Packages\User\Group
	 */
	private $group = null;

	/**
	 * @var bool
	 */
	private $isGuest = true;

	/**
	 * Creates a new User object
	 */
	public function __construct(?Session $session = null) {

		if($session !== null) {

			$this->session = $session;
		} else {

			if(session()->has('user_session')) {

				$session_token = session('user_session');
	
				$this->session = new Session($session_token);
			}
		}
	}

	/**
	 * Sets the user session
	 */
	public function setSession(Session $session) : User {

		$this->session = $session;

		return $this;
	}

	/**
	 * Loads user info from the database
	 */
	public function loadInfo() : void {

		if($this->session !== null && $this->session->isValid()) {

			$key = 'usrInfo_'. $this->session->getId();
			$cache = Cache::remember($key, CacheVisor::time('MINOR'), function() {

				$q = "SELECT 	core_users.id, core_users.username, core_users.avatar,
							core_users.user_group, core_users.not_count, core_users.mess_count,
							core_groups.name AS group_name
					FROM core_users INNER JOIN core_sessions ON
					core_users.id = core_sessions.user_id
					LEFT JOIN core_groups ON
					core_users.user_group = core_groups.id
					WHERE core_sessions.id = :session_id LIMIT 1";

				return DB::select($q, ['session_id' => $this->session->getId()]);
			});

			if(isset($cache[0]) && !empty($cache[0])) {

				$this->info = $cache[0];

				$this->isGuest = false;
			}
		}
	}

	public function loadGroupPermissions() : void {

		if($this->info !== null) {

			$this->group = new Group($this->info->user_group);

			$this->group->loadPermissions();
		}
	}

	/**
	 * Get the value of info
	 *
	 * @return  object
	 */
	public function getInfo() : ?object {

		return $this->info;
	}

	/**
	 * Get the value of session
	 *
	 * @return  App\Packages\User\Session
	 */
	public function getSession() : ?object {

		return $this->session;
	}

	/**
	 * Get the value of group
	 *
	 * @return  App\Packages\User\Group
	 */
	public function getGroup() : ?object {

		return $this->group;
	}

	/**
	 * Get the value of isGuest
	 *
	 * @return  bool
	 */
	public function isGuest() : bool {

		return $this->isGuest;
	}

	/**
	 * Check if a user can use a given action
	 */
	public function canUse(int $perm_group, int $perm) : bool {

		return $this->group->canUse($perm_group, $perm);
	}
}