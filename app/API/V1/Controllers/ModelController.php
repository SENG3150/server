<?php

namespace App\API\V1\Controllers;

use App\API\V1\Repositories\ModelRepository;
use App\API\V1\Transformers\ModelTransformer;
use Illuminate\Support\Collection;

class ModelController extends APIController
{
	public function getList(ModelRepository $modelRepository)
	{
		$models = $modelRepository->findAll();

		return $this->response->collection(Collection::make($models), new ModelTransformer());
	}

	public function get($modelId, ModelRepository $modelRepository)
	{
		$model = $modelRepository->find($modelId);

		return $this->response->item($model, new ModelTransformer());
	}
}