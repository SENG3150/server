<?php

namespace App\API\V1\Repositories;

use App\API\V1\Entities\InspectionSchedule;
use Doctrine\DBAL\Types\IntegerType;
use App\Repositories\Repository;
use Illuminate\Console\Scheduling\Schedule;

class InspectionRepository extends Repository
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