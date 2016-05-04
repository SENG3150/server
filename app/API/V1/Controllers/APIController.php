<?php

namespace App\API\V1\Controllers;

use App\Entities\User;
use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use JWTAuth;

class APIController extends BaseController
{
	use Helpers, ValidatesRequests;

	public function __construct()
	{
		App::register('App\API\V1\Providers\APIServiceProvider');
	}

	/**
	 * @return User
	 */
	public function getAuthenticatedUser()
	{
		try
		{
			if(($user = JWTAuth::parseToken()->authenticate()) == FALSE)
			{
				return response()->json(['user_not_found'], 404);
			}
		} catch(\Tymon\JWTAuth\Exceptions\TokenExpiredException $e)
		{
			throw new \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException('token_expired');
		} catch(\Tymon\JWTAuth\Exceptions\TokenInvalidException $e)
		{
			throw new \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException('token_invalid');
		} catch(\Tymon\JWTAuth\Exceptions\JWTException $e)
		{
			throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException('token_absent');
		}

		return $user;
	}

	/**
	 * @return User
	 */
	public function getUser()
	{
		return $this->getAuthenticatedUser();
	}

	public function validate(Request $request, array $rules, array $messages = [], array $customAttributes = [])
	{
		$validator = $this->getValidationFactory()->make($request->all(), $rules, $messages, $customAttributes);

		if($validator->fails())
		{
			throw new \Dingo\Api\Exception\ValidationHttpException($validator->errors());
		}
	}

	public function validateArray(array $array, array $rules, array $messages = [], array $customAttributes = [])
	{
		$validator = $this->getValidationFactory()->make($array, $rules, $messages, $customAttributes);

		if($validator->fails())
		{
			throw new \Dingo\Api\Exception\ValidationHttpException($validator->errors());
		}
	}
}
