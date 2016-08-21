<?php

namespace App\API\V1\Transformers;

use App\API\V1\Entities\SubAssembly;

class SubAssemblyTransformer extends Transformer
{
	/**
	 * @var array
	 */
	protected $availableIncludes = array(
		'majorAssembly',
		'tests',
		'inspections',
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
			'machineGeneral' => array(
				'test'  => $subAssembly->hasMachineGeneral(),
				'lower' => $subAssembly->getMachineGeneralLower(),
				'upper' => $subAssembly->getMachineGeneralUpper(),
			),
			'oil'            => array(
				'test'  => $subAssembly->hasOil(),
				'lower' => $subAssembly->getOilLower(),
				'upper' => $subAssembly->getOilUpper(),
			),
			'wear'           => array(
				'test'  => $subAssembly->hasWear(),
				'lower' => $subAssembly->getWearLower(),
				'upper' => $subAssembly->getWearUpper(),
			),
		);
	}

	/**
	 * @param SubAssembly $subAssembly
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeMajorAssembly(SubAssembly $subAssembly)
	{
		return $this->item($subAssembly->getMajorAssembly(), new MajorAssemblyTransformer());
	}

	/**
	 * @param SubAssembly $subAssembly
	 *
	 * @return \League\Fractal\Resource\Collection
	 */
	public function includeTests(SubAssembly $subAssembly)
	{
		return $this->collection($subAssembly->getTests(), new SubAssemblyTestTransformer());
	}

	/**
	 * @param SubAssembly $subAssembly
	 *
	 * @return \League\Fractal\Resource\Collection
	 */
	public function includeInspections(SubAssembly $subAssembly)
	{
		return $this->collection($subAssembly->getInspections(), new InspectionSubAssemblyTransformer());
	}
}