<?php

namespace App\API\V1\Repositories;

use App\API\V1\Entities\InspectionSchedule;
use Doctrine\DBAL\Types\IntegerType;
use Doctrine\ORM\EntityRepository;
use Illuminate\Console\Scheduling\Schedule;

class InspectionRepository extends EntityRepository
{
	public function findBySchedule(InspectionSchedule $schedule)
	{
		return $this->findBy(
			array(
				'schedule' => $schedule,
			)
		);
	}
}