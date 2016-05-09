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
			'machineGeneral' => array(
				'test'  => $subAssemblyTest->hasMachineGeneral(),
				'lower' => $subAssemblyTest->getMachineGeneralLower(),
				'upper' => $subAssemblyTest->getMachineGeneralUpper(),
			),
			'oil'            => array(
				'test'  => $subAssemblyTest->hasOil(),
				'lower' => $subAssemblyTest->getOilLower(),
				'upper' => $subAssemblyTest->getOilUpper(),
			),
			'wear'           => array(
				'test'  => $subAssemblyTest->hasWear(),
				'lower' => $subAssemblyTest->getWearLower(),
				'upper' => $subAssemblyTest->getWearUpper(),
			),
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