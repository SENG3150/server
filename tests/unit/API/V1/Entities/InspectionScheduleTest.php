<?php

namespace Tests\Unit\App\API\V1\Entities;

use App\API\V1\Entities\InspectionSchedule;
use TestCase;

class InspectionScheduleTest extends TestCase
{
	public function testID()
	{
		$randID = rand(100,150);
		$entity = new InspectionSchedule();
		$entity -> setId($randID);
		$this->assertTrue($entity->getId()==$randID);
	}

	public function testInspection()
	{
		$randID = rand(100,150);
		$entity = new InspectionSchedule();
		$entity -> setInspection($randID);
		$this->assertTrue($entity->getInspection()==$randID);
	}

	public function testInspections()
	{
		$randID = rand(100,150);
		$entity = new InspectionSchedule();
		$entity -> setInspections($randID);
		$this->assertTrue($entity->getInspections()==$randID);
	}

	public function testValue()
	{
		$randValue = rand(100,150);
		$entity = new InspectionSchedule();
		$entity -> setValue($randValue);
		$this->assertTrue($entity->getValue()==$randValue);
	}

	public function testSystemName()
	{
		$period = str_random(10);
		$entity = new InspectionSchedule();
		$entity -> setPeriod($period);
		$this->assertTrue($entity->getPeriod()==$period);
	}
}