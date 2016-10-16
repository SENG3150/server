<?php

namespace Tests\Unit\App\API\V1\Entities;


use App\API\V1\Entities\Technician;
use Carbon\Carbon;
use TestCase;

class TechnicianTest extends TestCase
{
	public function testID()
	{
		$randID = rand(100, 150);
		$entity = new Technician();
		$entity->setId($randID);
		$this->assertTrue($entity->getId() == $randID);
	}
	
	public function testUsername()
	{
		$username = str_random(10);
		$entity   = new Technician();
		$entity->setUsername($username);
		$this->assertTrue($entity->getUsername() == $username);
	}
	
	public function testFirstName()
	{
		$firstName = str_random(10);
		$entity    = new Technician();
		$entity->setFirstName($firstName);
		$this->assertTrue($entity->getFirstName() == $firstName);
	}
	
	public function testLastName()
	{
		$lastName = str_random(10);
		$entity   = new Technician();
		$entity->setLastName($lastName);
		$this->assertTrue($entity->getLastName() == $lastName);
	}
	
	public function testEmail()
	{
		$email  = str_random(10);
		$entity = new Technician();
		$entity->setEmail($email);
		$this->assertTrue($entity->getEmail() == $email);
	}
	
	public function testPassword()
	{
		$password = str_random(10);
		$entity   = new Technician();
		$entity->setPassword($password);
		$this->assertTrue($entity->matchesPassword($password));
	}
	
	
	public function testName()
	{
		$first  = str_random(10);
		$last   = str_random(10);
		$entity = new Technician();
		$entity->setFirstName($first);
		$entity->setLastName($last);
		$this->assertTrue($entity->getName() === $first . ' ' . $last);
	}
	
	public function testTemporary()
	{
		$temporary = rand(0, 1);
		$entity    = new Technician();
		$entity->setTemporary($temporary);
		$this->assertTrue($entity->isTemporary() == $temporary);
	}
	
	public function testLoginExpiresTime()
	{
		$year             = rand(2009, 2016);
		$month            = rand(1, 12);
		$day              = rand(1, 28);
		$hour             = rand(0, 23);
		$minute           = rand(0, 59);
		$second           = rand(0, 59);
		$loginExpiresTime = Carbon::create($year, $month, $day, $hour, $minute, $second);
		$entity           = new Technician();
		$entity->setLoginExpiresTime($loginExpiresTime);
		$this->assertTrue($entity->getLoginExpiresTime() == $loginExpiresTime);
	}
	
	public function testInspections()
	{
		$randID = rand(100, 150);
		$entity = new Technician();
		$entity->setInspections($randID);
		$this->assertTrue($entity->getInspections() == $randID);
	}
}