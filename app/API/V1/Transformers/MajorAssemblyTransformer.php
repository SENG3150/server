<?php

namespace App\API\V1\Transformers;

use League\Fractal\TransformerAbstract;

use App\API\V1\Entities\MajorAssembly;

class MajorAssemblyTransformer extends TransformerAbstract
{
	/**
	 * @var array
	 */
	protected $availableIncludes = array(
		'model',
		'subAssemblies',
	);

	/**
	 * @var array
	 */
	protected $defaultIncludes = array(
		'subAssemblies',
	);

	/**
	 * @param MajorAssembly $majorAssembly
	 *
	 * @return array
	 */
	public function transform(MajorAssembly $majorAssembly)
	{
		return array(
			'id'   => $majorAssembly->getId(),
			'name' => $majorAssembly->getName(),
		);
	}
	
	/**
	 * @param \App\API\V1\Entities\MajorAssembly $majorAssembly
	 *
	 * @return \League\Fractal\Resource\Collection
	 */
	public function includeModel(MajorAssembly $majorAssembly)
	{
		return $this->item($majorAssembly->getModel(), new ModelTransformer());
	}

	/**
	 * @param \App\API\V1\Entities\MajorAssembly $majorAssembly
	 *
	 * @return \League\Fractal\Resource\Collection
	 */
	public function includeSubAssemblies(MajorAssembly $majorAssembly)
	{
		return $this->collection($majorAssembly->getSubAssemblies(), new SubAssemblyTransformer());
	}
}