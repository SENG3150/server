<?php

namespace App\API\V1\Parsers;

use App\API\V1\Entities\ActionItem as Entity;
use App\API\V1\Repositories\ActionItemRepository as Repository;
use App\API\V1\Repositories\MachineGeneralTestRepository;
use App\API\V1\Repositories\OilTestRepository;
use App\API\V1\Repositories\WearTestRepository;
use App\API\V1\Repositories\TechnicianRepository;
use Illuminate\Http\Request;
use App;

class ActionItemParser extends Parser
{
	/** @var Repository $repository */
	var $repository;
	
	/** @var MachineGeneralTestRepository $machineGeneralTestRepository */
	var $machineGeneralTestRepository;
	
	/** @var OilTestRepository $oilTestRepository */
	var $oilTestRepository;
	
	/** @var WearTestRepository $wearTestRepository */
	var $wearTestRepository;
	
	/** @var TechnicianRepository $technicianRepository */
	var $technicianRepository;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->repository                   = App::make(Repository::class);
		$this->machineGeneralTestRepository = App::make(MachineGeneralTestRepository::class);
		$this->oilTestRepository            = App::make(OilTestRepository::class);
		$this->wearTestRepository           = App::make(WearTestRepository::class);
		$this->technicianRepository         = App::make(TechnicianRepository::class);
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
				'technician'   => 'required',
				'status'       => 'required',
				'issue'        => 'required',
				'action'       => 'required',
				'timeActioned' => 'required|isodatetime',
			)
		);
		
		$technician = $this->technicianRepository->find($input['technician']);
		
		if($technician != NULL)
		{
			$entity = new Entity();
			
			$entity
				->setTechnician($technician)
				->setStatus($input['status'])
				->setIssue($input['status'])
				->setAction($input['status'])
				->setTimeActioned(new \DateTime($input['status']));

			$testType = NULL;
			
			$test = $this->resolveOne(
				$input,
				array(
					'machineGeneralTest' => MachineGeneralTestRepository::class,
					'oilTest'            => OilTestRepository::class,
					'wearTest'           => WearTestRepository::class,
				),
				$testType
			);

			switch($testType)
			{
				case 'machineGeneralTest':
				{
					$entity
						->setMachineGeneralTest($test);

					break;
				}

				case 'oilTest':
				{
					$entity
						->setOilTest($test);

					break;
				}

				case 'wearTest':
				{
					$entity
						->setWearTest($test);

					break;
				}

				default:
				{
					throw new \Dingo\Api\Exception\ValidationHttpException(
						array(
							'test' => 'No test was specified.'
						)
					);
				}
			}

			$this->em->persist($entity);
			$this->em->flush();

			return $entity;
		}
		
		else
		{
			throw new \Dingo\Api\Exception\ValidationHttpException(
				array(
					'technician' => 'This technician does not exist.'
				)
			);
		}
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

			$this->resolve($entity, $input, 'status');
			$this->resolve($entity, $input, 'issue');
			$this->resolve($entity, $input, 'action');
			$this->resolve($entity, $input, 'timeActioned', 'datetime');
			$this->resolve($entity, $input, 'technician', 'entity', TechnicianRepository::class);

			$testType = NULL;

			$test = $this->resolveOne(
				$input,
				array(
					'machineGeneralTest' => MachineGeneralTestRepository::class,
					'oilTest'            => OilTestRepository::class,
					'wearTest'           => WearTestRepository::class,
				),
				$testType
			);

			switch($testType)
			{
				case 'machineGeneralTest':
				{
					$entity
						->setMachineGeneralTest($test)
						->setOilTest(NULL)
						->setWearTest(NULL);

					break;
				}

				case 'oilTest':
				{
					$entity
						->setMachineGeneralTest(NULL)
						->setOilTest($test)
						->setWearTest(NULL);

					break;
				}

				case 'wearTest':
				{
					$entity
						->setMachineGeneralTest(NULL)
						->setOilTest(NULL)
						->setWearTest($test);

					break;
				}

				default:
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