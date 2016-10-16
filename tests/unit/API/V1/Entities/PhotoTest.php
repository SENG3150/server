<?php

namespace Tests\Unit\App\API\V1\Entities;

use App\API\V1\Entities\DomainExpert;
use App\API\V1\Entities\Photo;
use App\API\V1\Entities\Technician;
use App\Entities\User;
use TestCase;

class PhotoTest extends TestCase
{
	public function testID()
	{
		$randID = rand(100, 150);
		$entity = new Photo();
		$entity->setId($randID);
		$this->assertTrue($entity->getId() == $randID);
	}
	
	public function testText()
	{
		$text   = str_random(10);
		$entity = new Photo();
		$entity->setText($text);
		$this->assertTrue($entity->getText() == $text);
	}
	
	public function testFormat()
	{
		$format = str_random(10);
		$entity = new Photo();
		$entity->setFormat($format);
		$this->assertTrue($entity->getFormat() == $format);
	}
	
	public function testInspection()
	{
		$randID = rand(100, 150);
		$entity = new Photo();
		$entity->setInspection($randID);
		$this->assertTrue($entity->getInspection() == $randID);
	}
	
	public function testMajorAssembly()
	{
		$randID = rand(100, 150);
		$entity = new Photo();
		$entity->setMajorAssembly($randID);
		$this->assertTrue($entity->getMajorAssembly() == $randID);
	}
	
	public function testSubAssembly()
	{
		$randID = rand(100, 150);
		$entity = new Photo();
		$entity->setSubAssembly($randID);
		$this->assertTrue($entity->getSubAssembly() == $randID);
	}
	
	public function testMachineGeneralTest()
	{
		$randID = rand(100, 150);
		$entity = new Photo();
		$entity->setMachineGeneralTest($randID);
		$this->assertTrue($entity->getMachineGeneralTest() == $randID);
	}
	
	public function testOilTest()
	{
		$randID = rand(100, 150);
		$entity = new Photo();
		$entity->setOilTest($randID);
		$this->assertTrue($entity->getOilTest() == $randID);
	}
	
	public function testWearTest()
	{
		$randID = rand(100, 150);
		$entity = new Photo();
		$entity->setWearTest($randID);
		$this->assertTrue($entity->getWearTest() == $randID);
	}
	
	public function testTechnician()
	{
		$randID = rand(100, 150);
		$entity = new Photo();
		$entity->setTechnician($randID);
		$this->assertTrue($entity->getTechnician() == $randID);
	}
	
	public function testDomainExpert()
	{
		$randID = rand(100, 150);
		$entity = new Photo();
		$entity->setDomainExpert($randID);
		$this->assertTrue($entity->getDomainExpert() == $randID);
	}
	
	public function testAuthorTechnician()
	{
		$randID     = rand(100, 150);
		$entity     = new Photo();
		$technician = new Technician();
		$technician->setId($randID);
		$entity->setTechnician($technician);
		$this->assertTrue($entity->getTechnician()->getId() == $randID);
	}
	
	public function testAuthorDomainExpert()
	{
		$randID       = rand(100, 150);
		$entity       = new Photo();
		$domainExpert = new DomainExpert();
		$domainExpert->setId($randID);
		$entity->setDomainExpert($domainExpert);
		$this->assertTrue($entity->getDomainExpert()->getId() == $randID);
	}
	
	public function testAuthorNull()
	{
		$entity = new Photo();
		$this->assertTrue($entity->getAuthor() == NULL);
	}
	
	public function testAuthorTypeDomainExpert()
	{
		$randID       = rand(100, 150);
		$entity       = new Photo();
		$domainExpert = new DomainExpert();
		$domainExpert->setId($randID);
		$entity->setDomainExpert($domainExpert);
		$this->assertTrue($entity->getAuthorType() == User::TYPE_DOMAIN_EXPERT);
	}
	
	public function testAuthorTypeTechnician()
	{
		$randID     = rand(100, 150);
		$entity     = new Photo();
		$technician = new Technician();
		$technician->setId($randID);
		$entity->setTechnician($technician);
		$this->assertTrue($entity->getAuthorType() == User::TYPE_TECHNICIAN);
	}
}