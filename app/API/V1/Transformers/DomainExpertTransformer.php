<?php

namespace App\API\V1\Transformers;

use App\API\V1\Entities\DomainExpert as Entity;
use App\Transformers\Transformer;

class DomainExpertTransformer extends Transformer
{
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
				'username'  => $entity->getUsername(),
				'name'      => $entity->getName(),
				'firstName' => $entity->getFirstName(),
				'lastName'  => $entity->getLastName(),
				'email'     => $entity->getEmail(),
				'emailHash' => md5(strtolower(trim($entity->getEmail()))),
			);
		}
		
		else
		{
			return array();
		}
	}
}