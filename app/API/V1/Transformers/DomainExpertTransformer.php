<?php

namespace App\API\V1\Transformers;

use League\Fractal\TransformerAbstract;

use App\API\V1\Entities\DomainExpert;

class DomainExpertTransformer extends TransformerAbstract
{
	/**
	 * @param DomainExpert $domainExpert
	 *
	 * @return array
	 */
	public function transform(DomainExpert $domainExpert)
	{
		return array(
			'id'        => $domainExpert->getId(),
			'username'  => $domainExpert->getUsername(),
			'name'      => $domainExpert->getName(),
			'firstName' => $domainExpert->getFirstName(),
			'lastName'  => $domainExpert->getLastName(),
			'email'     => $domainExpert->getEmail(),
		);
	}
}