<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

class FaviconController extends Controller
{
    public function display(Request $request, $state) {

		$state = strtolower($state);

		$iconPath = public_path(getTheme() .'/favicon.png');

		$image = imagecreatefrompng($iconPath);
		imagesavealpha($image, true);

		$red = imagecolorallocate($image, 255, 0, 0);
		$font = resource_path('fonts/Roboto/Roboto-Regular.ttf');

		switch($state) {

			case 'dev':
				imagettftext($image, 12, 0, 0, 28, $red, $font, 'DEV');
				break;

			default:
				imagettftext($image, 12, 0, 0, 28, $red, $font, 'MT');
				break;
		}
		

		ob_start();
		$rendered_buffer = imagepng($image);
		$buffer = ob_get_contents();
		imagedestroy($image);
		ob_end_clean();

		$response = Response::make($buffer);
		$response->header('Content-Type', 'image/png');

		return $response;
	}
}
