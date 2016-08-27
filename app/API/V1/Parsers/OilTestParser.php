<?php

namespace App\API\V1\Parsers;

use App\API\V1\Entities\OilTest as Entity;
use App\API\V1\Repositories\OilTestRepository as Repository;
use App\Parsers\Parser;
use Illuminate\Http\Request;
use App;

class OilTestParser extends Parser
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
				'inspection'  => 'required',
				'subAssembly' => 'required',
				'lead'        => 'required|integer',
				'copper'      => 'required|integer',
				'tin'         => 'required|integer',
				'iron'        => 'required|integer',
				'pq90'        => 'required|integer',
				'silicon'     => 'required|integer',
				'sodium'      => 'required|integer',
				'aluminium'   => 'required|integer',
				'water'       => 'required|numeric',
				'viscosity'   => 'required|integer',
			)
		);

		$entity = new Entity();

		$this->resolve($entity, $input, 'inspection', 'entity', App\API\V1\Repositories\InspectionRepository::class);
		$this->resolve($entity, $input, 'subAssembly', 'entity', App\API\V1\Repositories\InspectionSubAssemblyRepository::class);
		$this->resolve($entity, $input, 'lead', 'integer');
		$this->resolve($entity, $input, 'copper', 'integer');
		$this->resolve($entity, $input, 'tin', 'integer');
		$this->resolve($entity, $input, 'iron', 'integer');
		$this->resolve($entity, $input, 'pq90', 'integer');
		$this->resolve($entity, $input, 'silicon', 'integer');
		$this->resolve($entity, $input, 'sodium', 'integer');
		$this->resolve($entity, $input, 'aluminium', 'integer');
		$this->resolve($entity, $input, 'water', 'double');
		$this->resolve($entity, $input, 'viscosity', 'integer');

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
			$this->resolve($entity, $input, 'lead', 'integer');
			$this->resolve($entity, $input, 'copper', 'integer');
			$this->resolve($entity, $input, 'tin', 'integer');
			$this->resolve($entity, $input, 'iron', 'integer');
			$this->resolve($entity, $input, 'pq90', 'integer');
			$this->resolve($entity, $input, 'silicon', 'integer');
			$this->resolve($entity, $input, 'sodium', 'integer');
			$this->resolve($entity, $input, 'aluminium', 'integer');
			$this->resolve($entity, $input, 'water', 'double');
			$this->resolve($entity, $input, 'viscosity', 'integer');

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