<?php

namespace App\API\V1\Transformers;

use App\API\V1\Entities\DomainExpert;

class DomainExpertTransformer extends Transformer
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
			'emailHash' => md5(strtolower(trim($domainExpert->getEmail()))),
		);
	}
}