<?php

namespace Tests\Unit\App\API\V1\Entities;

use App\API\V1\Entities\Downtime;
use TestCase;

class DowntimeTest extends TestCase
{
	public function testID()
	{
		$randID = rand(100, 150);
		$entity = new Downtime();
		$entity->setId($randID);
		$this->assertTrue($entity->getId() == $randID);
	}
	
	public function testUsername()
	{
		$randID = rand(100, 150);
		$entity = new Downtime();
		$entity->setMachine($randID);
		$this->assertTrue($entity->getMachine() == $randID);
	}
	
	public function testSystemName()
	{
		$systemName = str_random(10);
		$entity     = new Downtime();
		$entity->setSystemName($systemName);
		$this->assertTrue($entity->getSystemName() == $systemName);
	}
	
	public function testDownTimeHours()
	{
		$downTimeHours = rand(100, 150);
		$entity        = new Downtime();
		$entity->setDownTimeHours($downTimeHours);
		$this->assertTrue($entity->getDownTimeHours() == $downTimeHours);
	}
	
	public function testReason()
	{
		$reason = str_random(10);
		$entity = new Downtime();
		$entity->setReason($reason);
		$this->assertTrue($entity->getReason() == $reason);
	}
}