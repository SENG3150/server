<?php

namespace Tests\Unit\App\API\V1\Entities;

use App\API\V1\Entities\DomainExpert;
use TestCase;

class DomainExpertTest extends TestCase
{
	/**
	 * @return string
	 */
	public function testUsername()
	{
		$username = str_random(10);
		$entity = new DomainExpert();
		$entity -> setUsername($username);
		$this->assertTrue($entity->getUsername()==$username);
	}

	/**
	 * @return string
	 */
	public function testFirstName()
	{
		$firstName = str_random(10);
		$entity = new DomainExpert();
		$entity -> setFirstName($firstName);
		$this->assertTrue($entity->getFirstName()==$firstName);
	}

	/**
	 * @return string
	 */
	public function testLastName()
	{
		$lastName = str_random(10);
		$entity = new DomainExpert();
		$entity -> setLastName($lastName);
		$this->assertTrue($entity->getLastName()==$lastName);
	}

	/**
	 * @return string
	 */
	public function testEmail()
	{
		$email = str_random(10);
		$entity = new DomainExpert();
		$entity -> setEmail($email);
		$this->assertTrue($entity->getEmail()==$email);
	}

	/**
	 * @return string
	 */
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