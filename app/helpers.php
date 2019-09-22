<?php

/* =============================================================================================

	This file contains all of the helper function which the core platform uses
	DO NOT place non core helpers inside this file but rather use the helpers_custom.php file

============================================================================================= */

#region System config helpers

if(!function_exists('rageConfig')) {

	// The platforms main configuration

	function rageConfig(?string $key = null, ?string $default = null) {

		return \RageConfig::getItem($key, $default);
	}
}

if(!function_exists('getTheme')) {

	// Gets the current platform theme

	function getTheme() : string {

		return rageConfig('theme', 'default');
	}
}

#endregion

#region Form builder helpers
if(!function_exists('createInput')) {

	/**
	 * Creates a html input
	 * Params $details [
	 * 	string name,
	 * 	string label,
	 * 	string type,
	 * 	string placeholder,
	 *	string value
	 * ]
	 */
	function createInput(array $details) : string {

		return \App\Packages\Core\FormBuilder::input($details);
	}
}
#endregion

/**
	Request helpers
 */

#region
if (!function_exists('getBrowser')) {

	function getBrowser() : array {

		return App\Packages\System\Request::getBrowser();
	}
}

if (!function_exists('getIp')) {

	function getIp() : string {

		return App\Packages\System\Request::getIp();
	}
}

if (!function_exists('getOS')) {

	function getOS() : string {

		return App\Packages\System\Request::getOS();
	}
}
#endregion

#region Misc helpers

if(!function_exists('favicon')) {

	function favicon() {

		return \App\Packages\Core\Favicon::generate();
	}
}

if(!function_exists('pageTitle')) {

	function pageTitle(?string $title = null) : string {

		$titleStr = '';

		if($title == null) {

			$titleStr = rageConfig('site_name');
		} else {
			
			$titleStr = $title;
		}

		$env = rageConfig('env', 'local');

		if($env == 'local') {

			$titleStr .= ' | Development';
		}

		if($env == 'maintenance') {

			$titleStr .= ' | Maintenance';
		}

		return $titleStr;
	}
}

#endregion