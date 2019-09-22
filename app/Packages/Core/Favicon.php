<?php

/**
 * Auto created by artisan on 30.07.2019 at 14:15
 * @author Champa
 */

namespace App\Packages\Core;

class Favicon
{
	public static function generate() : string {

		$iconPath = getTheme() .'/favicon.png';

		$state = rageConfig('env', 'local');

		if($state == 'production') {

			return $iconPath;
		}

		if($state == 'local') return '/favicon/dev';
		else return '/favicon/maintenance';
	}
}