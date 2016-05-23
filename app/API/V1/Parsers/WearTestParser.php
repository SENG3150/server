<?php

namespace App\API\V1\Parsers;

use App\API\V1\Entities\WearTest as Entity;
use App\API\V1\Repositories\WearTestRepository as Repository;
use Illuminate\Http\Request;
use App;

class WearTestParser extends Parser
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
				'inspection'    => 'required',
				'subAssembly'   => 'required',
				'description'   => 'required',
				'new'           => 'required',
				'limit'         => 'required',
				'lifeLower'     => 'required',
				'lifeUpper'     => 'required',
				'smu'           => 'required|integer',
				'timeStarted'   => 'required|isodatetime',
				'uniqueDetails' => 'required|array',
			)
		);
		
		$entity = new Entity();
		
		$this->resolve($entity, $input, 'inspection', 'entity', App\API\V1\Repositories\InspectionRepository::class);
		$this->resolve($entity, $input, 'subAssembly', 'entity', App\API\V1\Repositories\InspectionSubAssemblyRepository::class);
		$this->resolve($entity, $input, 'description');
		$this->resolve($entity, $input, 'new');
		$this->resolve($entity, $input, 'limit');
		$this->resolve($entity, $input, 'lifeLower');
		$this->resolve($entity, $input, 'lifeUpper');
		$this->resolve($entity, $input, 'smu', 'integer');
		$this->resolve($entity, $input, 'timeStarted', 'datetime');
		$this->resolve($entity, $input, 'uniqueDetails', 'array');
		
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

			$this->resolve($entity, $input, 'inspection', 'entity', App\API\V1\Repositories\InspectionRepository::class);
			$this->resolve($entity, $input, 'subAssembly', 'entity', App\API\V1\Repositories\InspectionSubAssemblyRepository::class);
			$this->resolve($entity, $input, 'description');
			$this->resolve($entity, $input, 'new');
			$this->resolve($entity, $input, 'limit');
			$this->resolve($entity, $input, 'lifeLower');
			$this->resolve($entity, $input, 'lifeUpper');
			$this->resolve($entity, $input, 'smu', 'integer');
			$this->resolve($entity, $input, 'timeStarted', 'datetime');
			$this->resolve($entity, $input, 'uniqueDetails', 'array');
			
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