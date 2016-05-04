<?php

namespace App\API\V1\Transformers;

use League\Fractal\TransformerAbstract;

use App\API\V1\Entities\Technician;

class TechnicianTransformer extends TransformerAbstract
{
	/**
	 * @param Technician $technician
	 *
	 * @return array
	 */
	public function transform(Technician $technician)
	{
		return array(
			'id'               => $technician->getId(),
			'name'             => $technician->getName(),
			'firstName'        => $technician->getFirstName(),
			'lastName'         => $technician->getLastName(),
			'email'            => $technician->getEmail(),
			'temporary'        => $technician->isTemporary(),
			'loginExpiresTime' => $technician->getLoginExpiresTime(),
			'expired'          => $technician->hasLoginExpired()
		);
	}
}