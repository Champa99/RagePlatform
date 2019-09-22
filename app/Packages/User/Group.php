<?php

/**
 * Auto created by artisan on 29.07.2019 at 23:18
 * @author Champa
 */

namespace App\Packages\User;

use Cache;
use DB;
use App\Packages\System\CacheVisor;

class Group
{
	/**
	 * @var array
	 */
	private $permissions = [];

	/**
	 * @var int
	 */
	private $groupId = null;

	/**
	 * Creates a new Group object
	 */
	public function __construct(int $groupId) {

		$this->groupId = $groupId;
	}

	/**
	 * Loads the permissions for a given group
	 */
	public function loadPermissions() {

		$key = 'grpPerm_'. $this->groupId;
		$this->permissions = Cache::remember($key, CacheVisor::time(), function() {

			$q = "SELECT perm_group, perm FROM core_group_permissions WHERE group_id = :group_id";
			$data = DB::select($q, ['group_id' => $this->groupId]);

			return self::groupPermissions($data);
		});
	}

	/**
	 * Groups the permissions in a perm_group => perm order
	 */
	private static function groupPermissions(array $permissions) : ?array {

		$tmp = [];

		foreach($permissions AS $item) {

			// If we havent set the subarray properly, we create it
			if(!isset($tmp[$item->perm_group])) {

				$tmp[$item->perm_group] = [];
			}

			// Add the item to our array (the perm)
			$tmp[$item->perm_group][$item->perm] = true;
		}

		return $tmp;
	}

	/**
	 * Get the value of permissions
	 *
	 * @return  array
	 */
	public function getPermissions() : ?array {

		return $this->permissions;
	}

	/**
	 * Check if a group can use a given action
	 */
	public function canUse(int $perm_group, int $perm) : bool {

		if($this->groupId == 1) return true;

		if(isset($this->permissions[$perm_group]) && isset($this->permissions[$perm_group][$perm]) && $this->permissions[$perm_group]) {

			return true;
		}

		return false;
	}
}