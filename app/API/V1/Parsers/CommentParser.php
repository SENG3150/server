<?php

namespace App\API\V1\Parsers;

use App\API\V1\Entities\Comment as Entity;
use App\API\V1\Repositories\CommentRepository as Repository;
use Illuminate\Http\Request;
use App;

class CommentParser extends Parser
{
	/** @var Repository $repository */
	var $repository;

	public function __construct()
	{
		parent::__construct();

		$this->repository = App::make(Repository::class);
	}

	/**
	 * @param Request|array $input
	 * @param bool          $recursive
	 *
	 * @return Entity
	 */
	public function create($input, $recursive = TRUE)
	{
		$input = $this->resolveInput($input);

		$this->validateArray(
			$input,
			array(
				'text'          => 'required',
				'timeCommented' => 'required|isodatetime',
			)
		);

		$authorType = NULL;

		$author = $this->resolveOne(
			$input,
			array(
				'domainExpert' => App\API\V1\Repositories\DomainExpertRepository::class,
				'technician'   => App\API\V1\Repositories\TechnicianRepository::class
			),
			$authorType
		);

		if($authorType == NULL)
		{
			throw new \Dingo\Api\Exception\ValidationHttpException(
				array(
					'author' => 'No author was set.'
				)
			);
		}

		$attachmentType = NULL;

		$attachment = $this->resolveOne(
			$input,
			array(
				'inspection'         => App\API\V1\Repositories\InspectionRepository::class,
				'majorAssembly'      => App\API\V1\Repositories\InspectionMajorAssemblyRepository::class,
				'subAssembly'        => App\API\V1\Repositories\InspectionSubAssemblyRepository::class,
				'machineGeneralTest' => App\API\V1\Repositories\MachineGeneralTestRepository::class,
				'oilTest'            => App\API\V1\Repositories\OilTestRepository::class,
				'wearTest'           => App\API\V1\Repositories\WearTestRepository::class,
			),
			$attachmentType
		);

		if($attachmentType == NULL)
		{
			throw new \Dingo\Api\Exception\ValidationHttpException(
				array(
					'attachment' => 'No attachment was set.'
				)
			);
		}

		$entity = new Entity();

		$this->resolve($entity, $input, 'text');
		$this->resolve($entity, $input, 'timeCommented', 'datetime');

		switch($authorType)
		{
			case 'domainExpert':
			{
				$entity
					->setDomainExpert($author);

				break;
			}

			case 'technician':
			{
				$entity
					->setTechnician($author);

				break;
			}
		}

		switch($attachmentType)
		{
			case 'inspection':
			{
				$entity
					->setInspection($attachment)
					->setMajorAssembly(NULL)
					->setSubAssembly(NULL)
					->setMachineGeneralTest(NULL)
					->setOilTest(NULL)
					->setWearTest(NULL);

				break;
			}

			case 'majorAssembly':
			{
				$entity
					->setInspection(NULL)
					->setMajorAssembly($attachment)
					->setSubAssembly(NULL)
					->setMachineGeneralTest(NULL)
					->setOilTest(NULL)
					->setWearTest(NULL);

				break;
			}

			case 'subAssembly':
			{
				$entity
					->setInspection(NULL)
					->setMajorAssembly(NULL)
					->setSubAssembly($attachment)
					->setMachineGeneralTest(NULL)
					->setOilTest(NULL)
					->setWearTest(NULL);

				break;
			}

			case 'machineGeneralTest':
			{
				$entity
					->setInspection(NULL)
					->setMajorAssembly(NULL)
					->setSubAssembly(NULL)
					->setMachineGeneralTest($attachment)
					->setOilTest(NULL)
					->setWearTest(NULL);

				break;
			}

			case 'oilTest':
			{
				$entity
					->setInspection(NULL)
					->setMajorAssembly(NULL)
					->setSubAssembly(NULL)
					->setMachineGeneralTest(NULL)
					->setOilTest($attachment)
					->setWearTest(NULL);

				break;
			}

			case 'wearTest':
			{
				$entity
					->setInspection(NULL)
					->setMajorAssembly(NULL)
					->setSubAssembly(NULL)
					->setMachineGeneralTest(NULL)
					->setOilTest(NULL)
					->setWearTest($attachment);

				break;
			}
		}

		$this->em->persist($entity);
		$this->em->flush();

		return $entity;
	}

	/**
	 * @param Request|array $input
	 * @param int           $id
	 * @param bool          $recursive
	 *
	 * @return Entity
	 */
	public function update($input, $id, $recursive = TRUE)
	{
		/** @var Entity $entity */
		$entity = $this->repository->find($id);

		if($entity != NULL)
		{
			$input = $this->resolveInput($input);

			$authorType = NULL;

			$author = $this->resolveOne(
				$input,
				array(
					'domainExpert' => App\API\V1\Repositories\DomainExpertRepository::class,
					'technician'   => App\API\V1\Repositories\TechnicianRepository::class,
				),
				$authorType
			);

			$attachmentType = NULL;

			$attachment = $this->resolveOne(
				$input,
				array(
					'inspection'         => App\API\V1\Repositories\InspectionRepository::class,
					'majorAssembly'      => App\API\V1\Repositories\InspectionMajorAssemblyRepository::class,
					'subAssembly'        => App\API\V1\Repositories\InspectionSubAssemblyRepository::class,
					'machineGeneralTest' => App\API\V1\Repositories\MachineGeneralTestRepository::class,
					'oilTest'            => App\API\V1\Repositories\OilTestRepository::class,
					'wearTest'           => App\API\V1\Repositories\WearTestRepository::class,
				),
				$attachmentType
			);

			$entity = new Entity();

			$this->resolve($entity, $input, 'text');
			$this->resolve($entity, $input, 'timeCommented', 'datetime');

			switch($authorType)
			{
				case 'domainExpert':
				{
					$entity
						->setDomainExpert($author)
						->setTechnician(NULL);

					break;
				}

				case 'technician':
				{
					$entity
						->setDomainExpert(NULL)
						->setTechnician($author);

					break;
				}

				case NULL:
				{
					break;
				}
			}

			switch($attachmentType)
			{
				case 'inspection':
				{
					$entity
						->setInspection($attachment)
						->setMajorAssembly(NULL)
						->setSubAssembly(NULL)
						->setMachineGeneralTest(NULL)
						->setOilTest(NULL)
						->setWearTest(NULL);

					break;
				}

				case 'majorAssembly':
				{
					$entity
						->setInspection(NULL)
						->setMajorAssembly($attachment)
						->setSubAssembly(NULL)
						->setMachineGeneralTest(NULL)
						->setOilTest(NULL)
						->setWearTest(NULL);

					break;
				}

				case 'subAssembly':
				{
					$entity
						->setInspection(NULL)
						->setMajorAssembly(NULL)
						->setSubAssembly($attachment)
						->setMachineGeneralTest(NULL)
						->setOilTest(NULL)
						->setWearTest(NULL);

					break;
				}

				case 'machineGeneralTest':
				{
					$entity
						->setInspection(NULL)
						->setMajorAssembly(NULL)
						->setSubAssembly(NULL)
						->setMachineGeneralTest($attachment)
						->setOilTest(NULL)
						->setWearTest(NULL);

					break;
				}

				case 'oilTest':
				{
					$entity
						->setInspection(NULL)
						->setMajorAssembly(NULL)
						->setSubAssembly(NULL)
						->setMachineGeneralTest(NULL)
						->setOilTest($attachment)
						->setWearTest(NULL);

					break;
				}

				case 'wearTest':
				{
					$entity
						->setInspection(NULL)
						->setMajorAssembly(NULL)
						->setSubAssembly(NULL)
						->setMachineGeneralTest(NULL)
						->setOilTest(NULL)
						->setWearTest($attachment);

					break;
				}

				case NULL:
				{
					break;
				}
			}

			$this->em->persist($entity);
			$this->em->flush();

			return $entity;
		}

		else
		{
			throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
		}
	}
}