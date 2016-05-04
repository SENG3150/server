<?php

namespace App\API\V1\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

use App\API\V1\Entities\Administrator;
use App\API\V1\Entities\DomainExpert;
use App\API\V1\Entities\Technician;

use App\API\V1\Repositories\AdministratorRepository;
use App\API\V1\Repositories\DomainExpertRepository;
use App\API\V1\Repositories\TechnicianRepository;

use App\API\V1\Transformers\AdministratorTransformer;
use App\API\V1\Transformers\DomainExpertTransformer;
use App\API\V1\Transformers\TechnicianTransformer;

class APIServiceProvider extends ServiceProvider
{
	/**
	 * @return void
	 */
	public function boot()
	{
		$this->app->bind('AdministratorRepository', \App\API\V1\Repositories\AdministratorRepository::class);
		$this->app->bind('DomainExpertRepository', \App\API\V1\Repositories\DomainExpertRepository::class);
		$this->app->bind('TechnicianRepository', \App\API\V1\Repositories\TechnicianRepository::class);

		$this->app->bind('AdministratorTransformer', \App\API\V1\Transformers\AdministratorTransformer::class);
		$this->app->bind('DomainExpertTransformer', \App\API\V1\Transformers\DomainExpertTransformer::class);
		$this->app->bind('TechnicianTransformer', \App\API\V1\Transformers\TechnicianTransformer::class);

		Validator::extend(
			'isodatetime',
			function ($attribute, $value, $parameters, $validator)
			{
				$pattern = '/^(\d\d\d\d)(-)?(\d\d)(-)?(\d\d)(T)?(\d\d)(:)?(\d\d)(:)?(\d\d)(\.\d+)?(Z|([+-])(\d\d)(:)?(\d\d))$/';

				return (boolean)preg_match($pattern, $value);
			},
			'The value :attribute must be a valid datetime in ISO 8601 format.'
		);
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			AdministratorRepository::class,
			function ($app)
			{
				return new AdministratorRepository(
					$app['em'],
					$app['em']->getClassMetaData(Administrator::class)
				);
			}
		);

		$this->app->bind(
			DomainExpertRepository::class,
			function ($app)
			{
				return new DomainExpertRepository(
					$app['em'],
					$app['em']->getClassMetaData(DomainExpert::class)
				);
			}
		);

		$this->app->bind(
			TechnicianRepository::class,
			function ($app)
			{
				return new TechnicianRepository(
					$app['em'],
					$app['em']->getClassMetaData(Technician::class)
				);
			}
		);

		$this->app->bind(
			AdministratorTransformer::class,
			function ($app)
			{
				return new AdministratorTransformer();
			}
		);

		$this->app->bind(
			DomainExpertTransformer::class,
			function ($app)
			{
				return new DomainExpertTransformer();
			}
		);

		$this->app->bind(
			TechnicianTransformer::class,
			function ($app)
			{
				return new TechnicianTransformer();
			}
		);

		$this->app['Dingo\Api\Transformer\Factory']->setAdapter(function ($app)
		{
			$fractal = new \League\Fractal\Manager;

			$fractal->setSerializer(new \App\Serializers\NoDataArraySerializer);

			return new \Dingo\Api\Transformer\Adapter\Fractal($fractal);
		}
		);
	}
}
