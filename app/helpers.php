<?php

if(function_exists('entity_dump') == FALSE)
{
	/**
	 * @param object $object
	 * @param int    $maxDepth
	 * @param bool   $stripTags
	 * @param bool   $echo
	 */
	function entity_dump($object, $maxDepth = 2, $stripTags = TRUE, $echo = TRUE)
	{
		echo '<pre>';
		\Doctrine\Common\Util\Debug::dump($object, $maxDepth, $stripTags, $echo);
		echo '</pre>';
	}
}

if(function_exists('generateRoutes') == FALSE)
{
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
}

if(function_exists('stringEndsWith') == FALSE)
{
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
}

if(function_exists('hasTrait') == FALSE)
{
	/**
	 * @param mixed $class
	 * @param string $trait
	 *
	 * @return bool
	 */
	function hasTrait($class, $trait)
	{
		return in_array($trait, class_uses($class));
	}
}