<?php

namespace App\API\V1\Transformers;

use App\API\V1\Entities\MajorAssembly;

class MajorAssemblyTransformer extends Transformer
{
	/**
	 * @var array
	 */
	protected $availableIncludes = array(
		'model',
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
	 * @param MajorAssembly $majorAssembly
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeModel(MajorAssembly $majorAssembly)
	{
		return $this->item($majorAssembly->getModel(), new ModelTransformer());
	}

	/**
	 * @param MajorAssembly $majorAssembly
	 *
	 * @return \League\Fractal\Resource\Collection
	 */
	public function includeSubAssemblies(MajorAssembly $majorAssembly)
	{
		return $this->collection($majorAssembly->getSubAssemblies(), new SubAssemblyTransformer());
	}
}