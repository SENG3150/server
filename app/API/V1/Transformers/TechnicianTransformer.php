<?php

namespace App\API\V1\Transformers;

use App\API\V1\Entities\Technician as Entity;
use App\Transformers\Transformer;

class TechnicianTransformer extends Transformer
{
	/**
	 * @param Entity $entity
	 *
	 * @return array
	 */
	protected $availableIncludes = array(
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
				'id'               => $entity->getId(),
				'username'         => $entity->getUsername(),
				'name'             => $entity->getName(),
				'firstName'        => $entity->getFirstName(),
				'lastName'         => $entity->getLastName(),
				'email'            => $entity->getEmail(),
				'temporary'        => $entity->isTemporary(),
				'loginExpiresTime' => $entity->getLoginExpiresTime(),
				'expired'          => $entity->hasLoginExpired(),
				'emailHash'        => $entity->getEmailHash(),
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
	 * @return array
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
	
	/**
	 * @param Entity $entity
	 *
	 * @return array
	 */
	public function includePhoto(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return $this->item($entity->getEmailHash(), new GravatarTransformer());
		}
		
		else
		{
			return NULL;
		}
	}
}