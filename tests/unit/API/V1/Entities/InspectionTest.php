<?php

namespace Tests\Unit\App\API\V1\Entities;

use App\API\V1\Entities\Inspection;
use Carbon\Carbon;
use TestCase;

class InspectionTest extends TestCase
{
	public function testID()
	{
		$randID = rand(100,150);
		$entity = new Inspection();
		$entity -> setId($randID);
		$this->assertTrue($entity->getId()==$randID);
	}
	
	public function testTimeCreated()
	{
		$year = rand(2009, 2016);
		$month = rand(1, 12);
		$day = rand(1, 28);
		$hour = rand(0, 23);
		$minute = rand(0, 59);
		$second = rand(0, 59);
		$timeCreated = Carbon::create($year,$month ,$day , $hour, $minute, $second)->format(DATE_ISO8601);
		$entity = new Inspection();
		$entity -> setTimeCreated($timeCreated);
		$this->assertTrue($entity->getTimeCreated()==$timeCreated);
	}

	public function testTimeSchedule()
	{
		$year = rand(2009, 2016);
		$month = rand(1, 12);
		$day = rand(1, 28);
		$hour = rand(0, 23);
		$minute = rand(0, 59);
		$second = rand(0, 59);
		$timeScheduled = Carbon::create($year,$month ,$day , $hour, $minute, $second)->format(DATE_ISO8601);
		$entity = new Inspection();
		$entity -> setTimeScheduled($timeScheduled);
		$this->assertTrue($entity->getTimeScheduled()==$timeScheduled);
	}

	public function testTimeStarted()
	{
		$year = rand(2009, 2016);
		$month = rand(1, 12);
		$day = rand(1, 28);
		$hour = rand(0, 23);
		$minute = rand(0, 59);
		$second = rand(0, 59);
		$timeStarted = Carbon::create($year,$month ,$day , $hour, $minute, $second)->format(DATE_ISO8601);
		$entity = new Inspection();
		$entity -> setTimeStarted($timeStarted);
		$this->assertTrue($entity->getTimeStarted()==$timeStarted);
	}

	public function testTimeCompleted()
	{
		$year = rand(2009, 2016);
		$month = rand(1, 12);
		$day = rand(1, 28);
		$hour = rand(0, 23);
		$minute = rand(0, 59);
		$second = rand(0, 59);
		$timeCompleted = Carbon::create($year,$month ,$day , $hour, $minute, $second)->format(DATE_ISO8601);
		$entity = new Inspection();
		$entity -> setTimeCompleted($timeCompleted);
		$this->assertTrue($entity->getTimeCompleted()==$timeCompleted);
	}

	public function testMachine()
	{
		$machine = rand(100,150);
		$entity = new Inspection();
		$entity -> setMachine($machine);
		$this->assertTrue($entity->getMachine()==$machine);
	}

	public function testTechnician()
	{
		$randID = rand(100,150);
		$entity = new Inspection();
		$entity -> setTechnician($randID);
		$this->assertTrue($entity->getTechnician()==$randID);
	}

	public function testScheduler()
	{
		$randID = rand(100,150);
		$entity = new Inspection();
		$entity -> setScheduler($randID);
		$this->assertTrue($entity->getScheduler()==$randID);
	}

	public function testSchedule()
	{
		$randID = rand(100,150);
		$entity = new Inspection();
		$entity -> setSchedule($randID);
		$this->assertTrue($entity->getSchedule()==$randID);
	}

	public function testMajorAssemblies()
	{
		$randID = rand(100,150);
		$entity = new Inspection();
		$entity -> setMajorAssemblies($randID);
		$this->assertTrue($entity->getMajorAssemblies()==$randID);
	}

	public function testComments()
	{
		$randID = rand(100,150);
		$entity = new Inspection();
		$entity -> setComments($randID);
		$this->assertTrue($entity->getComments()==$randID);
	}

	public function testPhotos()
	{
		$randID = rand(100,150);
		$entity = new Inspection();
		$entity -> setPhotos($randID);
		$this->assertTrue($entity->getPhotos()==$randID);
	}

	public function testSchedules()
	{
		$randID = rand(100,150);
		$entity = new Inspection();
		$entity -> setSchedules($randID);
		$this->assertTrue($entity->getSchedules()==$randID);
	}
}