<?php

namespace App\API\V1\Transformers;

use App\API\V1\Entities\OilTest as Entity;
use App\Transformers\Transformer;

class OilTestTransformer extends Transformer
{
	/**
	 * @var array
	 */
	protected $availableIncludes = array(
		'inspection',
		'subAssembly',
		'comments',
		'photos',
		'actionItem',
	);
	
	/**
	 * @var array
	 */
	protected $defaultIncludes = array(
		'comments',
		'photos',
		'actionItem',
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
				'id'        => $entity->getId(),
				'lead'      => $entity->getLead(),
				'copper'    => $entity->getCopper(),
				'tin'       => $entity->getTin(),
				'iron'      => $entity->getIron(),
				'pq90'      => $entity->getPq90(),
				'silicon'   => $entity->getSilicon(),
				'sodium'    => $entity->getSodium(),
				'aluminium' => $entity->getAluminium(),
				'water'     => floatval($entity->getWater()),
				'viscosity' => $entity->getViscosity(),
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
	public function includeInspection(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return $this->item($entity->getInspection(), new InspectionTransformer());
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
	public function includeSubAssembly(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return $this->item($entity->getSubAssembly(), new InspectionSubAssemblyTransformer());
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
	
	/**
	 * @param Entity $entity
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeActionItem(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return $this->item($entity->getActionItem(), new ActionItemTransformer());
		}
		
		else
		{
			return NULL;
		}
	}
}