<?php

namespace App\API\V1\Parsers;

use App\API\V1\Entities\Model as Entity;
use App\API\V1\Repositories\ModelRepository as Repository;
use Illuminate\Http\Request;
use App;

class ModelParser extends Parser
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
				'name' => 'required',
			)
		);

		$entity = new Entity();

		$entity
			->setName($input['name']);

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

			if(array_key_exists('name', $input) == TRUE)
			{
				$entity
					->setName($input['name']);
			}

			$this->em->persist($entity);
			$this->em->flush();
		}

		else
		{
			throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
		}
	}
}