<?php

/**
 * Auto created by artisan on 12.09.2019 at 21:45
 * @author Champa
 */

namespace App\Packages\System;

use Cache;
use DB;
use App\Packages\System\CacheVisor;

class Language
{
	public static function loadInstalled() : ?array {

		$key = 'lang_list';
		$cache = Cache::remember($key, CacheVisor::time(), function() {

			$q = "SELECT id, locale, language, strings_num FROM core_languages";
			return DB::select($q);
		});

		return $cache;
	}
}