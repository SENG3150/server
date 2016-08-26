<?php

namespace App\API\V1\Transformers;

use App\API\V1\Entities\Inspection as Entity;
use App\Transformers\Transformer;

class InspectionTransformer extends Transformer
{
	/**
	 * @var array
	 */
	protected $availableIncludes = array(
		'machine',
		'technician',
		'scheduler',
		'majorAssemblies',
		'comments',
		'photos',
	);
	
	/**
	 * @var array
	 */
	protected $defaultIncludes = array(
		'majorAssemblies',
		'comments',
		'photos',
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
				'id'            => $entity->getId(),
				'timeCreated'   => $entity->getTimeCreated(),
				'timeScheduled' => $entity->getTimeScheduled(),
				'timeStarted'   => $entity->getTimeStarted(),
				'timeCompleted' => $entity->getTimeCompleted(),
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
	public function includeMachine(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return $this->item($entity->getMachine(), new MachineTransformer());
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
	
	/**
	 * @param Entity $entity
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeScheduler(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return $this->item($entity->getScheduler(), new DomainExpertTransformer());
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
	public function includeMajorAssemblies(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return $this->collection($entity->getMajorAssemblies(), new InspectionMajorAssemblyTransformer());
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
	public function includeComments(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return $this->collection($entity->getComments(), new CommentTransformer());
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
	public function includePhotos(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return $this->collection($entity->getPhotos(), new PhotoTransformer());
		}
		
		else
		{
			return NULL;
		}
	}
}