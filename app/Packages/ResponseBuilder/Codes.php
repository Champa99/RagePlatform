<?php

/**
 * Auto created by artisan on 26.03.2019 at 15:37
 * @author Champa
 */

namespace App\Packages\ResponseBuilder;

use Cache;
use DB;
use App\Packages\System\CacheVisor;

class Codes
{
	// Regulator codes
	const EMPTY_FIELDS = 1;
	const API_BREACH =  2;

	// Registration codes
	const NAME_EXISTS = 10;
	const MAIL_EXISTS = 11;

	// Login codes
	const NO_ACCOUNT = 20;
	const WRONG_PASSWORD = 21;
}