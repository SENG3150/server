<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(
	App\API\V1\Entities\Administrator::class,
	function ()
	{
		return new App\API\V1\Entities\Administrator();
	}
);

$factory->define(
	App\API\V1\Entities\DomainExpert::class,
	function ()
	{
		return new \App\API\V1\Entities\DomainExpert();
	}
);

$factory->define(
	App\API\V1\Entities\Technician::class,
	function () use ($factory)
	{
		return new App\API\V1\Entities\Technician();
	}
);
