<?php

namespace App\API\V1\Controllers;

use App\API\V1\Repositories\InspectionRepository as Repository;
use App\API\V1\Transformers\InspectionTransformer as Transformer;
use Illuminate\Support\Collection;

class InspectionController extends APIController
{
	public function getList(Repository $repository)
	{
		$items = $repository->findAll();

		return $this->response->collection(Collection::make($items), new Transformer());
	}
	
	public function getIncompleteList(Repository $repository)
	{
		$items = $repository->findBy(
			array(
				'timeCompleted' => NULL
			)
		);

		return $this->response->collection(Collection::make($items), new Transformer());
	}

	public function get($id, Repository $repository)
	{
		$item = $repository->find($id);

		return $this->response->item($item, new Transformer());
	}
}