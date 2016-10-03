<?php

namespace Tests\Unit\App\API\V1\Entities;

use App\API\V1\Entities\SubAssembly;
use TestCase;

class SubAssemblyTest extends TestCase
{
	public function testID()
	{
		$randID = rand(100,150);
		$entity = new SubAssembly();
		$entity -> setId($randID);
		$this->assertTrue($entity->getId()==$randID);
	}
	
	public function testName()
	{
		$name = str_random(10);
		$entity = new SubAssembly();
		$entity -> setName($name);
		$this->assertTrue($entity->getName()==$name);
	}
	
	public function testMajorAssembly()
	{
		$randID = rand(100,150);
		$entity = new SubAssembly();
		$entity -> setMajorAssembly($randID);
		$this->assertTrue($entity->getMajorAssembly()==$randID);
	}
	
	public function testInspections()
	{
		$randID = rand(100,150);
		$entity = new SubAssembly();
		$entity -> setInspections($randID);
		$this->assertTrue($entity->getInspections()==$randID);
	}

	public function testMachineGeneralTest()
	{
		$randID = rand(0,1);
		$entity = new SubAssembly();
		$entity -> setMachineGeneral($randID);
		$this->assertTrue($entity->hasMachineGeneral()==$randID);
	}

	public function testOilTest()
	{
		$randID = rand(0,1);
		$entity = new SubAssembly();
		$entity -> setOil($randID);
		$this->assertTrue($entity->hasOil()==$randID);
	}

	public function testWearTest()
	{
		$randID = rand(0,1);
		$entity = new SubAssembly();
		$entity -> setWear($randID);
		$this->assertTrue($entity->hasWear()==$randID);
	}

	public function testUniqueDetails()
	{
		$uniqueDetails = str_random(10);
		$entity = new SubAssembly();
		$entity -> setUniqueDetails($uniqueDetails);
		$this->assertTrue($entity->getUniqueDetails()==$uniqueDetails);
	}
}