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
	function () use ($api)
	{
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
	function () use ($api)
	{
		$api->get('auth/me', 'App\API\V1\Controllers\UserController@me');
		$api->get('inspections/incomplete', 'App\API\V1\Controllers\InspectionController@getIncompleteList');
		$api->post('inspections/{id}/download', 'App\API\V1\Controllers\InspectionController@download');
		$api->get('inspections/{id}/graphs', 'App\API\V1\Controllers\InspectionController@graphs');
		$api->post('inspections/bulk', 'App\API\V1\Controllers\InspectionController@createBulk');
		$api->post('inspections/{id}/bulk', 'App\API\V1\Controllers\InspectionController@updateBulk');
		$api->get('photos/{id}/photo', 'App\API\V1\Controllers\PhotoController@photo');

		generateRoutes($api, 'v1', 'actionItems');
		generateRoutes($api, 'v1', 'administrators');
		generateRoutes($api, 'v1', 'comments');
		generateRoutes($api, 'v1', 'domainExperts');
		generateRoutes($api, 'v1', 'inspections');
		generateRoutes($api, 'v1', 'inspectionMajorAssemblies');
		generateRoutes($api, 'v1', 'inspectionSubAssemblies');
		generateRoutes($api, 'v1', 'machines');
		generateRoutes($api, 'v1', 'machineGeneralTests');
		generateRoutes($api, 'v1', 'majorAssemblies');
		generateRoutes($api, 'v1', 'models');
		generateRoutes($api, 'v1', 'oilTests');
		generateRoutes($api, 'v1', 'photos');
		generateRoutes($api, 'v1', 'subAssemblies');
		generateRoutes($api, 'v1', 'technicians');
		generateRoutes($api, 'v1', 'wearTests');
	}
);