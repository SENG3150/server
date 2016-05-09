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

		$api->get('machines', 'App\API\V1\Controllers\MachineController@getList');
		$api->get('machines/{id}', 'App\API\V1\Controllers\MachineController@get');

		$api->get('majorAssemblies', 'App\API\V1\Controllers\MajorAssemblyController@getList');
		$api->get('majorAssemblies/{id}', 'App\API\V1\Controllers\MajorAssemblyController@get');

		$api->get('models', 'App\API\V1\Controllers\ModelController@getList');
		$api->get('models/{id}', 'App\API\V1\Controllers\ModelController@get');

		$api->get('subAssemblies', 'App\API\V1\Controllers\SubAssemblyController@getList');
		$api->get('subAssemblies/{id}', 'App\API\V1\Controllers\SubAssemblyController@get');

		$api->get('subAssemblyTests', 'App\API\V1\Controllers\SubAssemblyTestController@getList');
		$api->get('subAssemblyTests/{id}', 'App\API\V1\Controllers\SubAssemblyTestController@get');
	}
);