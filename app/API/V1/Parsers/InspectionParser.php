<?php

namespace App\API\V1\Parsers;

use App\API\V1\Entities\Inspection as Entity;
use App\API\V1\Repositories\InspectionRepository as Repository;
use App\Parsers\Parser;
use Illuminate\Http\Request;
use App;

class InspectionParser extends Parser
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
		
		$entity = new Entity();
		
		$this->validateArray(
			$input,
			array(
				'machine'       => 'required',
				'technician'    => 'required',
				'timeScheduled' => 'required|isodatetime',
			)
		);
		
		$this->resolve($entity, $input, 'machine', 'entity', App\API\V1\Repositories\MachineRepository::class);
		$this->resolve($entity, $input, 'technician', 'entity', App\API\V1\Repositories\TechnicianRepository::class);
		$this->resolve($entity, $input, 'scheduler', 'entity', App\API\V1\Repositories\DomainExpertRepository::class);
		$this->resolve($entity, $input, 'timeScheduled', 'datetime');
		$this->resolve($entity, $input, 'timeStarted', 'datetime');
		$this->resolve($entity, $input, 'timeCompleted', 'datetime');
		
		$entity
			->setTimeCreated(new \DateTime());
		
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
			
			$this->resolve($entity, $input, 'machine', 'entity', App\API\V1\Repositories\MachineRepository::class);
			$this->resolve($entity, $input, 'technician', 'entity', App\API\V1\Repositories\TechnicianRepository::class);
			$this->resolve($entity, $input, 'scheduler', 'entity', App\API\V1\Repositories\DomainExpertRepository::class);
			$this->resolve($entity, $input, 'timeScheduled', 'datetime');
			$this->resolve($entity, $input, 'timeStarted', 'datetime');
			$this->resolve($entity, $input, 'timeCompleted', 'datetime');
			
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