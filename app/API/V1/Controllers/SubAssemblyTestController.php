<?php

namespace App\API\V1\Controllers;

use App\API\V1\Repositories\SubAssemblyTestRepository as Repository;
use App\API\V1\Transformers\SubAssemblyTestTransformer as Transformer;
use Illuminate\Support\Collection;

class SubAssemblyTestController extends APIController
{
	public function getList(Repository $repository)
	{
		$items = $repository->findAll();

		return $this->response->collection(Collection::make($items), new Transformer());
	}

	public function get($id, Repository $repository)
	{
		$item = $repository->find($id);

		return $this->response->item($item, new Transformer());
	}
}