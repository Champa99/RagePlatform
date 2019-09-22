<?php

/**
 * Auto created by artisan on 09.08.2019 at 21:09
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class LoggerFacade extends Facade
{

	/**
	 * Tells our facade what dependency to return
	 */

    protected static function getFacadeAccessor() {
		
		return 'platform.logger';
	}
}