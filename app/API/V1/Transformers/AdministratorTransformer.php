<?php

namespace App\API\V1\Transformers;

use App\API\V1\Entities\Administrator;
use App\Transformers\Transformer;

class AdministratorTransformer extends Transformer
{
	/**
	 * @param Administrator $administrator
	 *
	 * @return array
	 */
	public function transform(Administrator $administrator)
	{
		return array(
			'id'        => $administrator->getId(),
			'username'  => $administrator->getUsername(),
			'name'      => $administrator->getName(),
			'firstName' => $administrator->getFirstName(),
			'lastName'  => $administrator->getLastName(),
			'email'     => $administrator->getEmail(),
			'emailHash' => md5(strtolower(trim($administrator->getEmail()))),
		);
	}
}