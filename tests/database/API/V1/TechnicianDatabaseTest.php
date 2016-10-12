<?php

namespace Tests\Database\App\API\V1;

use App\API\V1\Entities\Technician;
use Doctrine\DBAL\Exception\NotNullConstraintViolationException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use TestCase;

class TechnicianDatabaseTest extends TestCase
{
	public function testMissingEmail()
	{
		$this->setExpectedException(NotNullConstraintViolationException::class, "Column 'email' cannot be null");
		
		$technician = new Technician();
		
		$technician
			->setUsername('technician2')
			->setPassword('technician')
			->setFirstName('firstName')
			->setLastName('lastName')
			->setTemporary(FALSE);
		
		$this->em->persist($technician);
		$this->em->flush();
	}
	
	public function testMissingUsername()
	{
		$this->setExpectedException(NotNullConstraintViolationException::class, "Column 'username' cannot be null");
		
		$technician = new Technician();
		
		$technician
			->setEmail('technician@example.com')
			->setPassword('technician')
			->setFirstName('firstName')
			->setLastName('lastName')
			->setTemporary(FALSE);
		
		$this->em->persist($technician);
		$this->em->flush();
	}
	
	public function testDuplicateUsername()
	{
		$this->setExpectedException(UniqueConstraintViolationException::class, "Duplicate entry 'technician'");
			
		$technician = new Technician();
		
		$technician
			->setUsername('technician')
			->setEmail('technician@example.com')
			->setPassword('technician')
			->setFirstName('firstName')
			->setLastName('lastName')
			->setTemporary(FALSE);
		
		$this->em->persist($technician);
		$this->em->flush();
	}
}