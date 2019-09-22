<?php

/**
 * Auto created by artisan on 09.08.2019 at 21:09
 * @author Champa
 */

namespace App\Packages\System;

use Cache;
use DB;
use App\Packages\System\CacheVisor;
use User;

class Logger
{
	public function write(string $action, string $lang_str, ?array $note = null) {

		$q = "INSERT INTO core_logs (log_date, member_name, lang_str, action, ip, note) VALUES
			(:log_date, :member_name, :lang_str, :action, :ip, :note)";
		
		DB::insert($q, [
			'log_date'		=>	time(),
			'member_name'	=> 	User::getInfo()->username,
			'lang_str'		=>	$lang_str,
			'action'		=>	$action,
			'ip'			=>	getIp(),
			'note'			=> 	json_encode($note)
		]);
	}
}