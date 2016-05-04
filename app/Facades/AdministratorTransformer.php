<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class AdministratorTransformer extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'AdministratorTransformer';
	}
}