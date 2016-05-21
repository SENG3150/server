<?php

namespace App\API\V1\Controllers;

use App\API\V1\Entities\MajorAssembly as Entity;
use App\API\V1\Entities\Model;
use App\API\V1\Repositories\MajorAssemblyRepository as Repository;
use App\API\V1\Repositories\ModelRepository;
use App\API\V1\Transformers\MajorAssemblyTransformer as Transformer;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class MajorAssemblyController extends APIController
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

	public function create(Request $request, ModelRepository $modelRepository, EntityManagerInterface $em)
	{
		$entity = new Entity();
		$input  = $request->input();

		$this->validateArray(
			$input,
			array(
				'name'  => 'required',
				'model' => 'required',
			)
		);

		/** @var Model $model */
		$model = $modelRepository->find($input['model']);

		if($model != NULL)
		{
			$entity
				->setName($input['name'])
				->setModel($model);

			$em->persist($entity);
			$em->flush();

			return $this->response()->created();
		}

		else
		{
			throw new \Dingo\Api\Exception\ValidationHttpException(
				array(
					'model' => 'This model does not exist.'
				)
			);
		}
	}

	public function update($id, Request $request, Repository $repository, ModelRepository $modelRepository, EntityManagerInterface $em)
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

			if(array_key_exists('model', $input) == TRUE)
			{
				/** @var Model $model */
				$model = $modelRepository->find($input['model']);

				if($model != NULL)
				{
					$entity
						->setModel($model);
				}

				else
				{
					throw new \Dingo\Api\Exception\ValidationHttpException(
						array(
							'model' => 'This model does not exist.'
						)
					);
				}
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