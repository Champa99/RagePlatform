<?php

/**
 * Auto created by artisan on 28.07.2019 at 23:54
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class SecureRoute extends Facade
{

	/**
	 * Tells our facade what dependency to return
	 */

    protected static function getFacadeAccessor() {
		
		return 'secure.route';
	}
}