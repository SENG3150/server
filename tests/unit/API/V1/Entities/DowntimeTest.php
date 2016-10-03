<?php

namespace Tests\Unit\App\API\V1\Entities;

use App\API\V1\Entities\Downtime;
use TestCase;

class DowntimeTest extends TestCase
{

	/**
	 * @return string
	 */
	public function testID()
	{
		$randID = rand(100,150);
		$entity = new Downtime();
		$entity -> setId($randID);
		$this->assertTrue($entity->getId()==$randID);
	}

	/**
	 * @return string
	 */
	public function testUsername()
	{
		$randID = rand(100,150);
		$entity = new Downtime();
		$entity -> setMachine($randID);
		$this->assertTrue($entity->getMachine()==$randID);
	}

	/**
	 * @return string
	 */
	public function testSystemName()
	{
		$systemName = str_random(10);
		$entity = new Downtime();
		$entity -> setSystemName($systemName);
		$this->assertTrue($entity->getSystemName()==$systemName);
	}


	/**
	 * @return string
	 */
	public function testDownTimeHours()
	{
		$downTimeHours = rand(100,150);
		$entity = new Downtime();
		$entity -> setDownTimeHours($downTimeHours);
		$this->assertTrue($entity->getDownTimeHours()==$downTimeHours);
	}


	/**
	 * @return string
	 */
	public function testReason()
	{
		$reason = str_random(10);
		$entity = new Downtime();
		$entity -> setReason($reason);
		$this->assertTrue($entity->getReason()==$reason);
	}
}