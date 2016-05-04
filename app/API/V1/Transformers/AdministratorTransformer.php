<?php

namespace App\API\V1\Transformers;

use League\Fractal\TransformerAbstract;

use App\API\V1\Entities\Administrator;

class AdministratorTransformer extends TransformerAbstract
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
			'name'      => $administrator->getName(),
			'firstName' => $administrator->getFirstName(),
			'lastName'  => $administrator->getLastName(),
			'email'     => $administrator->getEmail(),
		);
	}
}