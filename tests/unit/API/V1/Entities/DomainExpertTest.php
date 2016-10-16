<?php

namespace Tests\Unit\App\API\V1\Entities;

use App\API\V1\Entities\DomainExpert;
use TestCase;

class DomainExpertTest extends TestCase
{

	public function testUsername()
	{
		$username = str_random(10);
		$entity = new DomainExpert();
		$entity -> setUsername($username);
		$this->assertTrue($entity->getUsername()==$username);
	}

	public function testFirstName()
	{
		$firstName = str_random(10);
		$entity = new DomainExpert();
		$entity -> setFirstName($firstName);
		$this->assertTrue($entity->getFirstName()==$firstName);
	}

	public function testLastName()
	{
		$lastName = str_random(10);
		$entity = new DomainExpert();
		$entity -> setLastName($lastName);
		$this->assertTrue($entity->getLastName()==$lastName);
	}

	public function testEmail()
	{
		$email = str_random(10);
		$entity = new DomainExpert();
		$entity -> setEmail($email);
		$this->assertTrue($entity->getEmail()==$email);
	}
	
	public function testPassword()
	{
		$password = str_random(10);
		$entity = new DomainExpert();
		$entity -> setPassword($password);
		$this->assertTrue($entity->matchesPassword($password));
	}


	public function testName()
	{
		$first = str_random(10);
		$last = str_random(10);
		$entity = new DomainExpert();
		$entity -> setFirstName($first);
		$entity -> setLastName($last);
		$this->assertTrue($entity->getName()===$first.' '.$last);
	}
	
}