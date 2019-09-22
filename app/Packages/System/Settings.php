<?php

/**
 * Auto created by artisan on 09.08.2019 at 13:50
 * @author Champa
 */

namespace App\Packages\System;

use Cache;
use DB;
use App\Packages\System\CacheVisor;

class Settings
{
	public static function saveChanges(?array $changes) : bool {

		$currentSettings = rageConfig();
		$changesMade = false;

		DB::transaction(function() use ($currentSettings, $changes, &$changesMade) {
	
			foreach($changes AS $key => $change) {

				if($currentSettings[$key] != $change) {
	
					DB::update("UPDATE core_config SET `value` = :val WHERE `key` = :key LIMIT 1", [
						'val' => $change,
						'key' => $key
					]);

					$changesMade = true;
				}
			}

		}, 5);

		return $changesMade;
	}
}