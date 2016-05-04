<?php

namespace App\API\V1\Controllers;

use Dingo\Api\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;

class AuthenticateController extends BaseController
{
	/** @var \Tymon\JWTAuth\JWTAuth $auth */
	protected $auth;

	public function __construct(JWTAuth $auth)
	{
		App::register('App\API\V1\Providers\APIServiceProvider');

		$this->auth = $auth;
	}

	public function authenticate(Request $request)
	{
		$credentials = $request->only('type', 'userid', 'username', 'password');

		try
		{
			if(($token = $this->auth->attempt($credentials)) == FALSE)
			{
				return response()->json(['error' => 'invalid_credentials'], 401);
			}
		} catch(JWTException $e)
		{
			return response()->json(['error' => 'could_not_create_token'], 500);
		}

		return response()->json(compact('token'));
	}

	public function refresh()
	{
		if($this->auth->getToken() == FALSE)
		{
			throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException('token_absent');
		}

		try
		{
			$token = $this->auth->refresh();
		} catch(\Tymon\JWTAuth\Exceptions\TokenInvalidException $e)
		{
			throw new \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException('token_invalid');
		}

		return response()->json(compact('token'));
	}
}
