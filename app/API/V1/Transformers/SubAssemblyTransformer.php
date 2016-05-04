<?php

namespace App\API\V1\Transformers;

use League\Fractal\TransformerAbstract;

use App\API\V1\Entities\SubAssembly;

class SubAssemblyTransformer extends TransformerAbstract
{
	/**
	 * @var array
	 */
	protected $availableIncludes = array(
		'majorAssembly',
	);
	
	/**
	 * @param SubAssembly $subAssembly
	 *
	 * @return array
	 */
	public function transform(SubAssembly $subAssembly)
	{
		return array(
			'id'   => $subAssembly->getId(),
			'name' => $subAssembly->getName(),
		);
	}

	/**
	 * @param \App\API\V1\Entities\SubAssembly $subAssembly
	 *
	 * @return \League\Fractal\Resource\Collection
	 */
	public function includeMajorAssemblies(SubAssembly $subAssembly)
	{
		return $this->collection($subAssembly->getMajorAssembly(), new SubAssemblyTransformer());
	}
}