<?php

/**
 * @author Champa
 * Handles all application requests and checks if the user requesting the resources has the permission to use them
 */

namespace App\Http\Middleware;

use Closure;
use SecureRoute;
use User;
use App\Packages\User\Session;
use Cookie;

class Authenticator
{
    /**
     * Authenticate the user if he does an action that requires authentication
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		$uri = $request->path();
		$routeInfo = SecureRoute::getRoute($uri);

		if($routeInfo === null) {

			# If we're in a local env, we can let the unsecured routes go by
			# Otherwise, we throw a 404

			return (config('app.env') !== 'local') ? abort(404) : $next($request);
		}

		# Load the user details
		User::loadInfo();

		# Load the group permissions
		User::loadGroupPermissions();

		if($routeInfo['perm_group'] == 0 && $routeInfo['perm'] == 0) {
			# If the route doesnt have any permission requests, let the user pass

			return $next($request);
		}

		if(User::isGuest()) {
			# If the user is a guest, redirect them to the login page

			return redirect('/login');
		}

		if(User::canUse($routeInfo['perm_group'], $routeInfo['perm'])) {
			# If the usesr has the rights to see the page, show it to them, they deserved it lol

			return $next($request);
		}

		# Finaly if everything else fails, display a forbidden page error

		return abort(403);
    }
}