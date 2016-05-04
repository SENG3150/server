<?php

namespace App\API\V1\Transformers;

use League\Fractal\TransformerAbstract;

use App\API\V1\Entities\Model;

class ModelTransformer extends TransformerAbstract
{
	/**
	 * @var array
	 */
	protected $availableIncludes = array(
		'machines',
		'majorAssemblies',
	);

	/**
	 * @var array
	 */
	protected $defaultIncludes = array(
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
	 * @param \App\API\V1\Entities\Model $model
	 *
	 * @return \League\Fractal\Resource\Collection
	 */
	public function includeMajorAssemblies(Model $model)
	{
		return $this->collection($model->getMajorAssemblies(), new MajorAssemblyTransformer());
	}

	/**
	 * @param \App\API\V1\Entities\Model $model
	 *
	 * @return \League\Fractal\Resource\Collection
	 */
	public function includeMachines(Model $model)
	{
		return $this->collection($model->getMachines(), new MachineTransformer());
	}
}