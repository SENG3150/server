<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class DomainExpertTransformer extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'DomainExpertTransformer';
	}
}