<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class TechnicianRepository extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'TechnicianRepository';
	}
}