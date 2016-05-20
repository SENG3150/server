<?php

namespace App\API\V1\Controllers;

use App\API\V1\Entities\DomainExpert as Entity;
use App\API\V1\Repositories\DomainExpertRepository as Repository;
use App\API\V1\Transformers\DomainExpertTransformer as Transformer;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class DomainExpertController extends APIController
{
	public function getList(Repository $repository)
	{
		$entities = $repository->findAll();

		return $this->response->collection(Collection::make($entities), new Transformer());
	}

	public function get($id, Repository $repository)
	{
		$entity = $repository->find($id);

		if($entity != NULL)
		{
			return $this->response->item($entity, new Transformer());
		}

		else
		{
			$this->response()->errorNotFound();

			return FALSE;
		}
	}

	public function create(Request $request, Repository $repository, EntityManagerInterface $em)
	{
		$entity = new Entity();
		$input  = $request->input();

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

		if($entity->getId() == NULL || $input['username'] != $entity->getUsername())
		{
			if($repository->findOneBy(array('username' => $input['username'])) != NULL)
			{
				throw new \Dingo\Api\Exception\ValidationHttpException(
					array(
						'username' => 'This username is already registered.'
					)
				);
			}
		}

		$entity
			->setUsername($input['username'])
			->setFirstName($input['firstName'])
			->setLastName($input['lastName'])
			->setEmail($input['email'])
			->setPassword($input['password']);

		$em->persist($entity);
		$em->flush();

		return $this->response()->created();
	}

	public function update($id, Request $request, Repository $repository, EntityManagerInterface $em)
	{
		$entity = $repository->find($id);

		if($entity != NULL)
		{
			$input = $request->input();

			if(array_key_exists('username', $input) == TRUE)
			{
				if($input['username'] != $entity->getUsername())
				{
					if($repository->findOneBy(array('username' => $input['username'])) != NULL)
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
			
			$em->persist($entity);
			$em->flush();

			return $this->response()->accepted();
		}

		else
		{
			$this->response()->errorNotFound();

			return FALSE;
		}
	}

	public function delete($id, Repository $repository, EntityManagerInterface $em)
	{
		$entity = $repository->find($id);

		if($entity != NULL)
		{
			$em->remove($entity);
			$em->flush();

			return $this->response()->accepted();
		}

		else
		{
			$this->response()->errorNotFound();

			return FALSE;
		}
	}
}