<?php

/**
 * Auto created by artisan on 03.12.2018 at 13:33
 * @author Champa
 */

namespace App\Packages\ResponseBuilder;

class Builder
{
	/**
	 * @var Response
	 */
	private $response = null;

	public function __construct() {

		$this->response = new Response();
	}

	/**
	 * Builds a success response
	 */

	public function success(array $payload = []) {

		return $this->generateResponse(true, 0, 'OK', time(), $payload);
	}

	/**
	 * Builds an error reponse
	 */

	public function error(int $code, array $payload = []) {

		return $this->generateResponse(false, $code, __('apicodes.'. $code), time(), $payload);
	}

	/**
	 * Builds the response
	 */

	private function generateResponse(?bool $success, ?int $code, ?string $message, ?int $timestamp, ?array $payload) {

		$this->response->setSuccess($success);
		$this->response->setCode($code);
		$this->response->setMessage($message);
		$this->response->setTimestamp($timestamp);
		$this->response->setPayload($payload);
		$this->response->setLocale(config('app.locale'));

		$res = $this->response->get();

		return json_encode($res);
	}
}