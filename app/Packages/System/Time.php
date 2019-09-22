<?php

/**
 * Auto created by artisan on 25.09.2018 at 19:54
 * @author Champa
 */

namespace App\Packages\System;

use Cache;
use DB;

class Time
{
	const HOUR = 3600;

	const DAY = 86400;

	const WEEK = 604800;

	public static function HoursToSeconds(int $hours) : int {

		return $hours * 3600;
	}

	public static function StampToReadable(int $timestamp) : string {

		return date("d.m.Y", $timestamp) .' at '. date("H:i", $timestamp);
	}

	public static function timePassed(int $timestamp) : string {

		if($timestamp == 0) {

			return trans_choice('time.seconds', 0);
		}

		$between = time() - $timestamp;

		$time = round($between / 86400);

		if($time > 0) {

			return trans_choice('time.days', $time);
		}

		$time = round($between / 3600);

		if($time > 0) {

			return trans_choice('time.hours', $time);
		}

		return trans_choice('time.seconds', $between);
	}
}