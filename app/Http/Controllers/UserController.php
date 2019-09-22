<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ResponseBuilder;
use Cookie;
use App\Packages\ResponseBuilder\Codes;
use App\Packages\User\{Registration, Login, Session, User AS DirectUser};

class UserController extends Controller
{
    public function login(Request $request, $state = null) {

		if($request->isMethod('GET')) {

			$sessionCookie = Cookie::get('_rpt');

			
			if($sessionCookie === null) {

				return view('user.login', [
					'state' => $state
				]);
			}

			if($state == 'reset') {

				Cookie::queue(Cookie::forget('_rpt'));

				return view('user.login', [
					'state' => $state
				]);
			}

			$session = new Session($sessionCookie);
			$user = new DirectUser($session);

			if($session->isValid()) {

				$user->loadInfo();

				return view('user.login_back', [
					'user_info'	=>	$user->getInfo()
				]);
			}

			return view('user.login', [
				'state' => $state
			]);
		}

		if($request->isMethod('POST')) {

			if(!$request->filled(['login_logon', 'login_password'])) {

				return ResponseBuilder::error(Codes::EMPTY_FIELDS);
			}

			$login = new Login();

			$login
					->setUserLogOn($request->input('login_logon'))
					->setPassword($request->input('login_password'));

			$login->attempt();

			if($login->getStatus() == 0) {

				$token = Session::create($login->getUserId());

				// The browser session
				session(['user_session' => $token]);

				// The cookie we set so we can tell the user was logged on if the session expires (a login confirmation menu will be shown)
				Cookie::queue('_rpt', $token, 525600);

				return ResponseBuilder::success();
			}

			return ResponseBuilder::error($login->getStatus());
		}
	}

	public function register(Request $request) {

		if($request->isMethod('GET')) {
		
			return view('user.register');
		}

		if($request->isMethod('POST')) {

			if(!$request->filled(['register_username', 'register_email', 'register_password'])) {

				return ResponseBuilder::error(Codes::EMPTY_FIELDS);
			}

			$registration = new Registration();

			$registration
						->setUsername($request->input('register_username'))
						->setEmail($request->input('register_email'))
						->setPassword($request->input('register_password'));
			
			$registration->attempt();

			if($registration->getStatus() == 0)
				return ResponseBuilder::success();

			else
				return ResponseBuilder::error($registration->getStatus());
		}
	}
}
