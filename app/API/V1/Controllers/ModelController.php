<?php

namespace App\API\V1\Controllers;

use App\API\V1\Repositories\ModelRepository as Repository;
use App\API\V1\Transformers\ModelTransformer as Transformer;
use Illuminate\Support\Collection;

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
}