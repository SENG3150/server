<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/** @var Dingo\Api\Routing\Router $api */
$api = app('Dingo\Api\Routing\Router');

$api->version(
	'v1',
	[],
	function ($api)
	{
		/** @var Dingo\Api\Routing\Router $api */
		$api->post('auth/authenticate', 'App\API\V1\Controllers\AuthenticateController@authenticate');
		$api->get('auth/refresh', 'App\API\V1\Controllers\AuthenticateController@refresh');
	}
);

$api->version(
	'v1',
	[
		'middleware' => 'api.auth',
		'provider'   => 'jwt'
	],
	function ($api)
	{
		/** @var Dingo\Api\Routing\Router $api */
		$api->get('me', 'App\API\V1\Controllers\UserController@me');
	}
);