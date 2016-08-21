<?php

namespace App\API\V1\Providers;

use App\API\V1\Entities\ActionItem;
use App\API\V1\Entities\Administrator;
use App\API\V1\Entities\Comment;
use App\API\V1\Entities\DomainExpert;
use App\API\V1\Entities\Downtime;
use App\API\V1\Entities\Inspection;
use App\API\V1\Entities\InspectionMajorAssembly;
use App\API\V1\Entities\InspectionSubAssembly;
use App\API\V1\Entities\Machine;
use App\API\V1\Entities\MachineGeneralTest;
use App\API\V1\Entities\MajorAssembly;
use App\API\V1\Entities\Model;
use App\API\V1\Entities\OilTest;
use App\API\V1\Entities\Photo;
use App\API\V1\Entities\SubAssembly;
use App\API\V1\Entities\Technician;
use App\API\V1\Entities\WearTest;

use App\API\V1\Repositories\ActionItemRepository;
use App\API\V1\Repositories\AdministratorRepository;
use App\API\V1\Repositories\CommentRepository;
use App\API\V1\Repositories\DomainExpertRepository;
use App\API\V1\Repositories\DowntimeRepository;
use App\API\V1\Repositories\InspectionRepository;
use App\API\V1\Repositories\InspectionMajorAssemblyRepository;
use App\API\V1\Repositories\InspectionSubAssemblyRepository;
use App\API\V1\Repositories\MachineRepository;
use App\API\V1\Repositories\MachineGeneralTestRepository;
use App\API\V1\Repositories\MajorAssemblyRepository;
use App\API\V1\Repositories\ModelRepository;
use App\API\V1\Repositories\OilTestRepository;
use App\API\V1\Repositories\PhotoRepository;
use App\API\V1\Repositories\SubAssemblyRepository;
use App\API\V1\Repositories\TechnicianRepository;
use App\API\V1\Repositories\WearTestRepository;

use App\API\V1\Transformers\AdministratorTransformer;
use App\API\V1\Transformers\DomainExpertTransformer;
use App\API\V1\Transformers\TechnicianTransformer;

use Doctrine\DBAL\Types\Type;
use Illuminate\Support\ServiceProvider;
use Validator;

class APIServiceProvider extends ServiceProvider
{
	/**
	 * @return void
	 */
	public function boot()
	{
		Type::overrideType('datetime', 'App\API\V1\Providers\DateTimeTypeProvider');

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
			ActionItemRepository::class,
			function ($app)
			{
				return new ActionItemRepository(
					$app['em'],
					$app['em']->getClassMetaData(ActionItem::class)
				);
			}
		);

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
			CommentRepository::class,
			function ($app)
			{
				return new CommentRepository(
					$app['em'],
					$app['em']->getClassMetaData(Comment::class)
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
			DowntimeRepository::class,
			function ($app)
			{
				return new DowntimeRepository(
					$app['em'],
					$app['em']->getClassMetaData(Downtime::class)
				);
			}
		);

		$this->app->bind(
			InspectionMajorAssemblyRepository::class,
			function ($app)
			{
				return new InspectionMajorAssemblyRepository(
					$app['em'],
					$app['em']->getClassMetaData(InspectionMajorAssembly::class)
				);
			}
		);

		$this->app->bind(
			InspectionRepository::class,
			function ($app)
			{
				return new InspectionRepository(
					$app['em'],
					$app['em']->getClassMetaData(Inspection::class)
				);
			}
		);

		$this->app->bind(
			InspectionScheduleRepository::class,
			function ($app)
			{
				return new InspectionScheduleRepository(
					$app['em'],
					$app['em']->getClassMetaData(InspectionSchedule::class)
				);
			}
		);

		$this->app->bind(
			InspectionSubAssemblyRepository::class,
			function ($app)
			{
				return new InspectionSubAssemblyRepository(
					$app['em'],
					$app['em']->getClassMetaData(InspectionSubAssembly::class)
				);
			}
		);

		$this->app->bind(
			MachineGeneralTestRepository::class,
			function ($app)
			{
				return new MachineGeneralTestRepository(
					$app['em'],
					$app['em']->getClassMetaData(MachineGeneralTest::class)
				);
			}
		);

		$this->app->bind(
			MachineRepository::class,
			function ($app)
			{
				return new MachineRepository(
					$app['em'],
					$app['em']->getClassMetaData(Machine::class)
				);
			}
		);

		$this->app->bind(
			MajorAssemblyRepository::class,
			function ($app)
			{
				return new MajorAssemblyRepository(
					$app['em'],
					$app['em']->getClassMetaData(MajorAssembly::class)
				);
			}
		);

		$this->app->bind(
			ModelRepository::class,
			function ($app)
			{
				return new ModelRepository(
					$app['em'],
					$app['em']->getClassMetaData(Model::class)
				);
			}
		);

		$this->app->bind(
			OilTestRepository::class,
			function ($app)
			{
				return new OilTestRepository(
					$app['em'],
					$app['em']->getClassMetaData(OilTest::class)
				);
			}
		);

		$this->app->bind(
			PhotoRepository::class,
			function ($app)
			{
				return new PhotoRepository(
					$app['em'],
					$app['em']->getClassMetaData(Photo::class)
				);
			}
		);

		$this->app->bind(
			SubAssemblyRepository::class,
			function ($app)
			{
				return new SubAssemblyRepository(
					$app['em'],
					$app['em']->getClassMetaData(SubAssembly::class)
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
			WearTestRepository::class,
			function ($app)
			{
				return new WearTestRepository(
					$app['em'],
					$app['em']->getClassMetaData(WearTest::class)
				);
			}
		);

		$this->app->bind(
			AdministratorTransformer::class,
			function ()
			{
				return new AdministratorTransformer();
			}
		);

		$this->app->bind(
			DomainExpertTransformer::class,
			function ()
			{
				return new DomainExpertTransformer();
			}
		);

		$this->app->bind(
			TechnicianTransformer::class,
			function ()
			{
				return new TechnicianTransformer();
			}
		);

		$this->app['Dingo\Api\Transformer\Factory']->setAdapter(function ()
		{
			$fractal = new \League\Fractal\Manager;

			$fractal->setSerializer(new \App\Serializers\NoDataArraySerializer);

			return new \Dingo\Api\Transformer\Adapter\Fractal($fractal);
		}
		);
	}
}
