<?php

namespace App\API\V1\Transformers;

use League\Fractal\TransformerAbstract;

use App\API\V1\Entities\SubAssemblyTest;

class SubAssemblyTestTransformer extends TransformerAbstract
{
	/**
	 * @var array
	 */
	protected $availableIncludes = array(
		'subAssembly',
	);
	
	/**
	 * @param SubAssemblyTest $subAssemblyTest
	 *
	 * @return array
	 */
	public function transform(SubAssemblyTest $subAssemblyTest)
	{
		return array(
			'id'             => $subAssemblyTest->getId(),
			'machineGeneral' => $subAssemblyTest->hasMachineGeneral(),
			'oil'            => $subAssemblyTest->hasOil(),
			'wear'           => $subAssemblyTest->hasWear(),
		);
	}

	/**
	 * @param \App\API\V1\Entities\SubAssemblyTest $subAssemblyTest
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeSubAssembly(SubAssemblyTest $subAssemblyTest)
	{
		return $this->item($subAssemblyTest->getSubAssembly(), new SubAssemblyTransformer());
	}
}