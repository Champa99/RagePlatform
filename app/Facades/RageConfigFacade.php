<?php

/**
 * Auto created by artisan on 30.07.2019 at 11:50
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class RageConfigFacade extends Facade
{

	/**
	 * Tells our facade what dependency to return
	 */

    protected static function getFacadeAccessor() {
		
		return 'platform.config';
	}
}