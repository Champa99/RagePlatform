<?php

/**
 * Auto created by artisan on 10.08.2019 at 16:21
 * @author Champa
 */

namespace App\Packages\Core;

use Cache;
use DB;
use App\Packages\System\CacheVisor;

class Buttons
{

	private static $list = [];

	public static function load() {

		$key = 'coreBtns';
		self::$list = Cache::remember($key, CacheVisor::time(), function() {

			$q = "SELECT id, parent, lang_str, link, expandable FROM core_buttons ORDER BY display_order";

			$data = DB::select($q);

			return self::sortButtons($data);
		});
	}

	public static function add(string $lang_str, string $link, bool $expandable, int $display_order, int $parent) : ?int {

		$q = "INSERT INTO core_buttons (parent, lang_str, link, expandable, display_order) VALUES
			(:parent, :lang_str, :link, :expandable, :display_order)";

		DB::insert($q, [
			'parent' => $parent,
			'lang_str' => $lang_str,
			'link' => $link,
			'expandable' => $expandable,
			'display_order' => $display_order
		]);

		return DB::getPdo()->lastInsertId();
	}

	public static function saveOrder(array $buttons) {

		DB::transaction(function() use ($buttons) {

			foreach($buttons AS $i => $button) {

				$q = "UPDATE core_buttons SET parent = :parent, display_order = :display_order WHERE id = :bid LIMIT 1";
				DB::update($q, [
					'parent'		=>	$button['parent'],
					'display_order'	=>	$button['display_order'],
					'bid'			=>	$i
				]);
			}
		});
	}

	private static function sortButtons(?array $buttons) : array {

		$newList = [];

		foreach($buttons AS $button) {

			if($button->parent == 0) {

				$newList[$button->id] = $button;
			} else {

				if(!isset($newList[$button->parent]->children)) {

					$newList[$button->parent]->children = [];
				}
				
				$newList[$button->parent]->children[$button->id] = $button;
			}
		}

		return $newList;
	}

	public static function getList() : ?array {

		return self::$list;
	}
}