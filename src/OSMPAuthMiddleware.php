<?php

namespace Gabievi\OSMP;

use Closure;

class OSMPAuthMiddleware
{

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 *
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] !== config('osmp.username') || $_SERVER['PHP_AUTH_PW'] !== config('osmp.secret')) {
			header('WWW-Authenticate: Basic realm="OSMP"');
			abort(401, 'Unauthorized');
		}

		return $next($request);
	}
}
