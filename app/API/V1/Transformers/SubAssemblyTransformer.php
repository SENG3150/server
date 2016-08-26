<?php

namespace App\API\V1\Transformers;

use App\API\V1\Entities\SubAssembly;
use App\Transformers\Transformer;

class SubAssemblyTransformer extends Transformer
{
	/**
	 * @var array
	 */
	protected $availableIncludes = array(
		'majorAssembly',
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
			'id'             => $subAssembly->getId(),
			'name'           => $subAssembly->getName(),
			'machineGeneral' => $subAssembly->hasMachineGeneral(),
			'oil'            => $subAssembly->hasOil(),
			'wear'           => $subAssembly->hasWear(),
			'uniqueDetails'  => $subAssembly->getUniqueDetails(),
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
	public function includeInspections(SubAssembly $subAssembly)
	{
		return $this->collection($subAssembly->getInspections(), new InspectionSubAssemblyTransformer());
	}
}