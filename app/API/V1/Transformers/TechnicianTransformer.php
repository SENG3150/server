<?php

namespace App\API\V1\Transformers;

use App\API\V1\Entities\Technician;

class TechnicianTransformer extends Transformer
{
	/**
	 * @param Technician $technician
	 *
	 * @return array
	 */
	protected $availableIncludes = array(
		'inspections',
			);
	public function transform(Technician $technician)
	{
		return array(
			'id'               => $technician->getId(),
			'username'         => $technician->getUsername(),
			'name'             => $technician->getName(),
			'firstName'        => $technician->getFirstName(),
			'lastName'         => $technician->getLastName(),
			'email'            => $technician->getEmail(),
			'temporary'        => $technician->isTemporary(),
			'loginExpiresTime' => $technician->getLoginExpiresTime(),
			'expired'          => $technician->hasLoginExpired(),
			'emailHash'        => md5(strtolower(trim($technician->getEmail()))),
		);
	}
	/**
	 * @param Technician $technician
	 *
	 * @return array
	 */
	public function includeInspections(Technician $technician){
		return $this->collection($technician->getInspections(), new InspectionTransformer());

		//search inspections for Technician=this.id
		//return array of those inspections
	}

}