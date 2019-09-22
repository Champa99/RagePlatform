<?php

/**
 * Auto created by artisan on 15.08.2019 at 16:15
 * @author Champa
 */

namespace App\Packages\Core;

use Cache;
use DB;
use App\Packages\System\CacheVisor;

class FormBuilder
{
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
	public static function input(array $details) : string {

		if(!isset($details['name'])) {

			throw new \Exception("Input tag must have a name ( input(['name' => 'The name']) )");
		}

		return '<div class="row rage-input-holder mb-2" id="'. $details['name'] .'_holder">

			<div class="col-4 input-col label">'. isset($details['label']) ? $details['label'] : '' .'</div>

			<div class="col-8 input-col">
				<input type="'. isset($details['type']) ? $details['type'] : '' .'"
					name="'. $details['name'] .'" id="'. $details['name'] .'"
					placeholder="'. isset($details['placeholder']) ? $details['placeholder'] : '' .'"
					value="'. isset($details['value']) ? $details['value'] : '' .'" />
			</div>
		</div>';
	}
}