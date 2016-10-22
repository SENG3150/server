<?php

namespace Tests\Unit\App\API\V1\Entities;

use App\API\V1\Entities\OilTest;
use TestCase;

class OilTestTest extends TestCase
{
	public function testID()
	{
		$randID = rand(100, 150);
		$entity = new OilTest();
		$entity->setId($randID);
		$this->assertTrue($entity->getId() == $randID);
	}
	
	public function testInspection()
	{
		$randID = rand(100, 150);
		$entity = new OilTest();
		$entity->setInspection($randID);
		$this->assertTrue($entity->getInspection() == $randID);
	}
	
	public function testSubAssembly()
	{
		$randID = rand(100, 150);
		$entity = new OilTest();
		$entity->setSubAssembly($randID);
		$this->assertTrue($entity->getSubAssembly() == $randID);
	}
	
	public function testActionItem()
	{
		$randID = rand(100, 150);
		$entity = new OilTest();
		$entity->setActionItem($randID);
		$this->assertTrue($entity->getActionItem() == $randID);
	}
	
	public function testComments()
	{
		$randID = rand(100, 150);
		$entity = new OilTest();
		$entity->setComments($randID);
		$this->assertTrue($entity->getComments() == $randID);
	}
	
	public function testPhotos()
	{
		$randID = rand(100, 150);
		$entity = new OilTest();
		$entity->setPhotos($randID);
		$this->assertTrue($entity->getPhotos() == $randID);
	}
	
	public function testLead()
	{
		$randID = rand(100, 150);
		$entity = new OilTest();
		$entity->setLead($randID);
		$this->assertTrue($entity->getLead() == $randID);
	}
	
	public function testCopper()
	{
		$copper = rand(100, 150);
		$entity = new OilTest();
		$entity->setCopper($copper);
		$this->assertTrue($entity->getCopper() == $copper);
	}
	
	public function testTin()
	{
		$tin    = rand(100, 150);
		$entity = new OilTest();
		$entity->setTin($tin);
		$this->assertTrue($entity->getTin() == $tin);
	}
	
	public function testIron()
	{
		$iron   = rand(100, 150);
		$entity = new OilTest();
		$entity->setIron($iron);
		$this->assertTrue($entity->getIron() == $iron);
	}
	
	public function testPq90()
	{
		$pq90   = rand(100, 150);
		$entity = new OilTest();
		$entity->setPq90($pq90);
		$this->assertTrue($entity->getPq90() == $pq90);
	}
	
	public function testSilicon()
	{
		$silicon = rand(100, 150);
		$entity  = new OilTest();
		$entity->setSilicon($silicon);
		$this->assertTrue($entity->getSilicon() == $silicon);
	}
	
	public function testSodium()
	{
		$sodium = rand(100, 150);
		$entity = new OilTest();
		$entity->setSodium($sodium);
		$this->assertTrue($entity->getSodium() == $sodium);
	}
	
	public function testAluminium()
	{
		$aluminium = rand(100, 150);
		$entity    = new OilTest();
		$entity->setAluminium($aluminium);
		$this->assertTrue($entity->getAluminium() == $aluminium);
	}
	
	public function testWater()
	{
		$water  = rand(0, 10) / 10;
		$entity = new OilTest();
		$entity->setWater($water);
		$this->assertTrue($entity->getWater() == $water);
	}
	
	public function testViscosity()
	{
		$viscosity = rand(100, 150);
		$entity    = new OilTest();
		$entity->setViscosity($viscosity);
		$this->assertTrue($entity->getViscosity() == $viscosity);
	}
}