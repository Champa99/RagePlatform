<?php

/**
 * Auto created by artisan on 31.07.2019 at 12:29
 * @author Champa
 */

namespace App\Packages\System;

use Cache;
use DB;
use App\Packages\System\CacheVisor;

class Versionist
{

	public static function getVersion() : ?string {

		return rageConfig('platform_version', '0.0.0');
	}

	public static function copyrightText() : string {

		$yearStarted = 2019;
		$currentYear = date("Y");

		if($yearStarted != $currentYear) $yearStr = $yearStarted .' - '. $currentYear;
		else $yearStr = $yearStarted;

		return 'RAGE Industries &#169; '. $yearStr .' | Platform version '. rageConfig('platform_version');
	}
}