<?php

/**
 * Auto created by artisan on 30.07.2019 at 17:40
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ResponseBuilderFacade extends Facade
{

	/**
	 * Tells our facade what dependency to return
	 */

    protected static function getFacadeAccessor() {
		
		return 'response.builder';
	}
}