<?php

namespace App\API\V1\Parsers;

use App\API\V1\Entities\InspectionMajorAssembly as Entity;
use App\API\V1\Repositories\InspectionMajorAssemblyRepository as Repository;
use Illuminate\Http\Request;
use App;

class InspectionMajorAssemblyParser extends Parser
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
	 */
	public function create($input, $recursive = TRUE)
	{
		$input = $this->resolveInput($input);

		$this->validateArray(
			$input,
			array(
			)
		);

		$entity = new Entity();

		$this->em->persist($entity);
		$this->em->flush();
	}

	/**
	 * @param Request|array $input
	 * @param int           $id
	 * @param bool          $recursive
	 */
	public function update($input, $id, $recursive = TRUE)
	{
		/** @var Entity $entity */
		$entity = $this->repository->find($id);

		if($entity != NULL)
		{
			$input = $this->resolveInput($input);

			$this->em->persist($entity);
			$this->em->flush();
		}

		else
		{
			throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
		}
	}
}