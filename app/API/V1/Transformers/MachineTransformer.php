<?php

namespace App\API\V1\Transformers;

use App\API\V1\Entities\Machine as Entity;
use App\Transformers\Transformer;

class MachineTransformer extends Transformer
{
	/**
	 * @var array
	 */
	protected $availableIncludes = array(
		'model',
		'inspections',
		'downtime',
	);
	
	/**
	 * @var array
	 */
	protected $defaultIncludes = array(
		'model',
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
				'id'   => $entity->getId(),
				'name' => $entity->getName(),
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
	public function includeModel(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return $this->item($entity->getModel(), new ModelTransformer());
		}
		
		else
		{
			return NULL;
		}
	}
	
	/**
	 * @param Entity $entity
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeDowntime(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return $this->item($entity->getDowntime(), new DowntimeTransformer());
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
			return $this->collection($entity->getInspections(), new InspectionTransformer());
		}
		
		else
		{
			return NULL;
		}
	}
}