<?php

namespace App\API\V1\Transformers;

use App\API\V1\Entities\ActionItem as Entity;
use App\Transformers\Transformer;

class ActionItemTransformer extends Transformer
{
	/**
	 * @var array
	 */
	protected $availableIncludes = array(
		'machineGeneralTest',
		'oilTest',
		'wearTest',
		'technician',
	);
	
	/**
	 * @var array
	 */
	protected $defaultIncludes = array(
		'technician',
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
				'id'           => $entity->getId(),
				'status'       => $entity->getStatus(),
				'issue'        => $entity->getIssue(),
				'action'       => $entity->getAction(),
				'timeActioned' => $entity->getTimeActioned(),
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
	public function includeMachineGeneralTest(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return $this->item($entity->getMachineGeneralTest(), new MachineGeneralTestTransformer());
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
	public function includeOilTest(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return $this->item($entity->getOilTest(), new OilTestTransformer());
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
	public function includeWearTest(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return $this->item($entity->getWearTest(), new WearTestTransformer());
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
	public function includeTechnician(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return $this->item($entity->getTechnician(), new TechnicianTransformer());
		}
		
		else
		{
			return NULL;
		}
	}
}