<?php

namespace Gabievi\OSMP;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class OSMPServiceProvider extends ServiceProvider
{

	/**
	 * Bootstrap the application services.
	 *
	 * @param \Illuminate\Routing\Router $router
	 */
	public function boot(Router $router)
	{
		$this->loadViewsFrom(__DIR__ . '/views', 'osmp');

		$this->publishes([
			__DIR__ . '/config.php' => config_path('osmp.php'),
		]);

		$router->middleware('osmp.auth', OSMPAuthMiddleware::class);
	}

	/**
	 * Register the application services.
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom(__DIR__ . '/config.php', 'osmp');

		$this->app['osmp'] = $this->app->share(function () {
			return new OSMP();
		});
	}
}
