<?php

namespace App\API\V1\Controllers;

use App\API\V1\Entities\Model as Entity;
use App\API\V1\Repositories\ModelRepository as Repository;
use App\API\V1\Transformers\ModelTransformer as Transformer;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class ModelController extends APIController
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

	public function create(Request $request, EntityManagerInterface $em)
	{
		$entity = new Entity();
		$input  = $request->input();

		$this->validateArray(
			$input,
			array(
				'name' => 'required',
			)
		);

		$entity
			->setName($input['name']);

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

			if(array_key_exists('name', $input) == TRUE)
			{
				$entity
					->setName($input['name']);
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