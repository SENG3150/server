<?php

namespace App\API\V1\Transformers;

use App\API\V1\Entities\SubAssembly as Entity;
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
	 * @param Entity $entity
	 *
	 * @return array
	 */
	public function transform(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return array(
				'id'             => $entity->getId(),
				'name'           => $entity->getName(),
				'machineGeneral' => $entity->hasMachineGeneral(),
				'oil'            => $entity->hasOil(),
				'wear'           => $entity->hasWear(),
				'uniqueDetails'  => $entity->getUniqueDetails(),
			);
		}
		
		else
		{
			return array();
		}
	}
	
	/**
	 * @param Entity $entity
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeMajorAssembly(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return $this->item($entity->getMajorAssembly(), new MajorAssemblyTransformer());
		}
		
		else
		{
			return NULL;
		}
	}
	
	/**
	 * @param Entity $entity
	 *
	 * @return \League\Fractal\Resource\Collection
	 */
	public function includeInspections(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return $this->collection($entity->getInspections(), new InspectionSubAssemblyTransformer());
		}
		
		else
		{
			return NULL;
		}
	}
}