<?php

namespace App\API\V1\Parsers;

use App\API\V1\Entities\DomainExpert as Entity;
use App\API\V1\Repositories\DomainExpertRepository as Repository;
use Illuminate\Http\Request;
use App;

class DomainExpertParser extends Parser
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

		$entity = new Entity();

		$entity
			->setUsername($input['username'])
			->setFirstName($input['firstName'])
			->setLastName($input['lastName'])
			->setEmail($input['email'])
			->setPassword($input['password']);

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

				$entity
					->setUsername($input['username']);
			}

			if(array_key_exists('firstName', $input) == TRUE)
			{
				$entity
					->setFirstName($input['firstName']);
			}

			if(array_key_exists('lastName', $input) == TRUE)
			{
				$entity
					->setLastName($input['lastName']);
			}

			if(array_key_exists('email', $input) == TRUE)
			{
				$entity
					->setEmail($input['email']);
			}

			if(array_key_exists('password', $input) == TRUE)
			{
				$entity
					->setPassword($input['password']);
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