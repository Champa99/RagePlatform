<?php

/**
 * Auto created by artisan on 29.07.2019 at 00:04
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class UserFacade extends Facade
{

	/**
	 * Tells our facade what dependency to return
	 */

    protected static function getFacadeAccessor() {
		
		return 'platform.user';
	}
}