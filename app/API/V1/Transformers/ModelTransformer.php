<?php

namespace App\API\V1\Transformers;

use App\API\V1\Entities\Model;

class ModelTransformer extends Transformer
{
	/**
	 * @var array
	 */
	protected $availableIncludes = array(
		'machines',
		'majorAssemblies',
	);
	
	/**
	 * @param Model $model
	 *
	 * @return array
	 */
	public function transform(Model $model)
	{
		return array(
			'id'   => $model->getId(),
			'name' => $model->getName(),
		);
	}

	/**
	 * @param Model $model
	 *
	 * @return \League\Fractal\Resource\Collection
	 */
	public function includeMajorAssemblies(Model $model)
	{
		return $this->collection($model->getMajorAssemblies(), new MajorAssemblyTransformer());
	}

	/**
	 * @param Model $model
	 *
	 * @return \League\Fractal\Resource\Collection
	 */
	public function includeMachines(Model $model)
	{
		return $this->collection($model->getMachines(), new MachineTransformer());
	}
}