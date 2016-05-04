<?php

namespace App\Providers;

use Auth;
use App\Providers\UserProvider;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * Perform post-registration booting of services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Auth::provider('user', function ($app, array $config)
		{
			return new UserProvider();
		}
		);
	}

	/**
	 * Register bindings in the container.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}