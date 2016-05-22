<?php

namespace App\API\V1\Parsers;

use App\API\V1\Entities\Administrator as Entity;
use App\API\V1\Repositories\AdministratorRepository as Repository;
use Illuminate\Http\Request;
use App;

class AdministratorParser extends Parser
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
				'username'  => 'required',
				'firstName' => 'required',
				'lastName'  => 'required',
				'email'     => 'required',
				'password'  => 'required',
			)
		);

		if($this->repository->findOneBy(array('username' => $input['username'])) != NULL)
		{
			throw new \Dingo\Api\Exception\ValidationHttpException(
				array(
					'username' => 'This username is already registered.'
				)
			);
		}

		$entity = new Entity();

		$this->resolve($entity, $input, 'username');
		$this->resolve($entity, $input, 'firstName');
		$this->resolve($entity, $input, 'lastName');
		$this->resolve($entity, $input, 'email');
		$this->resolve($entity, $input, 'password');

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

			if(array_key_exists('username', $input) == TRUE)
			{
				if($input['username'] != $entity->getUsername())
				{
					if($this->repository->findOneBy(array('username' => $input['username'])) != NULL)
					{
						throw new \Dingo\Api\Exception\ValidationHttpException(
							array(
								'username' => 'This username is already registered.'
							)
						);
					}
				}

				$this->resolve($entity, $input, 'username');
			}

			$this->resolve($entity, $input, 'firstName');
			$this->resolve($entity, $input, 'lastName');
			$this->resolve($entity, $input, 'email');
			$this->resolve($entity, $input, 'password');

			$this->em->persist($entity);
			$this->em->flush();
		}

		else
		{
			throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
		}
	}
}