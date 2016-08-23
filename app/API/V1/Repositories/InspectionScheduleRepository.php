<?php

namespace App\API\V1\Repositories;

use Doctrine\ORM\EntityRepository;

class InspectionScheduleRepository extends EntityRepository
{
	public function findByVisible()
	{
		return $this->findBy(
			array(
				'hidden' => FALSE,
			)
		);
	}
}