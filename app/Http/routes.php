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
		generateRoutes($api, 'v1', 'subAssemblies');
		generateRoutes($api, 'v1', 'subAssemblyTests');
		generateRoutes($api, 'v1', 'technicians');
		generateRoutes($api, 'v1', 'wearTests');
	}
);

/**
 * @param Dingo\Api\Routing\Router $api
 * @param string                   $version
 * @param string                   $route
 * @param string                   $controller
 * @param bool                     $getList
 * @param bool                     $get
 * @param bool                     $create
 * @param bool                     $update
 * @param bool                     $delete
 */
function generateRoutes($api, $version, $route, $controller = NULL, $getList = TRUE, $get = TRUE, $create = TRUE, $update = TRUE, $delete = TRUE)
{
	if($controller == NULL)
	{
		$controller = ucfirst($route);

		if(stringEndsWith($controller, 's') == TRUE)
		{
			$controller = substr($controller, 0, -1);
		}

		if(stringEndsWith($controller, 'ie') == TRUE)
		{
			$controller = substr($controller, 0, -2) . 'y';
		}
	}

	$path = "App\\API\\" . strtoupper($version) . "\\Controllers\\" . $controller . "Controller@";

	if($getList == TRUE)
	{
		$api->get($route, $path . 'getList');
	}

	if($get == TRUE)
	{
		$api->get($route . '/{id}', $path . 'get');
	}

	if($create == TRUE)
	{
		$api->post($route, $path . 'create');
	}

	if($update == TRUE)
	{
		$api->post($route . '/{id}', $path . 'update');
	}

	if($delete == TRUE)
	{
		$api->delete($route . '/{id}', $path . 'delete');
	}
}

/**
 * @param $haystack
 * @param $needle
 *
 * @return bool
 * @link http://stackoverflow.com/a/10473026
 */
function stringEndsWith($haystack, $needle)
{
	// search forward starting from end minus needle length characters
	return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
}