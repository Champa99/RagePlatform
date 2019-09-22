<?php

/**
 * Auto created by artisan on 30.07.2019 at 11:41
 * @author Champa
 */

namespace App\Packages\System;

use Cache;
use DB;
use App\Packages\System\CacheVisor;

class RageConfig
{
	/**
	 * @var array
	 */
	private $items = [];

	/**
	 * Creates a new Config object
	 */
	public function __construct() {
		
		$this->load();
	}

	/**
	 * Loads the config from the cache/database
	 */
	private function load() {

		$key = 'platformConfig';

		$this->items = Cache::remember($key, CacheVisor::time(), function() {

			$q = "SELECT core_config.key, core_config.value FROM core_config";
			$data = DB::select($q);

			return self::groupConfigItems($data);
		});
	}

	/**
	 * Groups the config from the database into a new object with key->value structure
	 */
	private static function groupConfigItems(?array $items) : ?array {

		$tmp = [];

		foreach($items AS $item) {

			$tmp[$item->key] = $item->value;
		}

		return $tmp;
	}

	/**
	 * Get the value of items
	 *
	 * @return  mixed
	 */
	public function getItem(?string $key = null, ?string $default = null) {

		if($key === null) {

			return $this->items;
		}

		if(isset($this->items[$key])) {

			return $this->items[$key];
		}

		return $default;
	}
}