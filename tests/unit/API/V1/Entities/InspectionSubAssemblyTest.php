<?php

namespace Tests\Unit\App\API\V1\Entities;

use App\API\V1\Entities\InspectionSubAssembly;
use TestCase;

class InspectionSubAssemblyTest extends TestCase
{
	public function testID()
	{
		$randID = rand(100, 150);
		$entity = new InspectionSubAssembly();
		$entity->setId($randID);
		$this->assertTrue($entity->getId() == $randID);
	}
	
	public function testInspection()
	{
		$randID = rand(100, 150);
		$entity = new InspectionSubAssembly();
		$entity->setInspection($randID);
		$this->assertTrue($entity->getInspection() == $randID);
	}
	
	public function testMajorAssembly()
	{
		$randID = rand(100, 150);
		$entity = new InspectionSubAssembly();
		$entity->setMajorAssembly($randID);
		$this->assertTrue($entity->getMajorAssembly() == $randID);
	}
	
	public function testSubAssembly()
	{
		$randID = rand(100, 150);
		$entity = new InspectionSubAssembly();
		$entity->setSubAssembly($randID);
		$this->assertTrue($entity->getSubAssembly() == $randID);
	}
	
	public function testComments()
	{
		$randID = rand(100, 150);
		$entity = new InspectionSubAssembly();
		$entity->setComments($randID);
		$this->assertTrue($entity->getComments() == $randID);
	}
	
	public function testPhotos()
	{
		$randID = rand(100, 150);
		$entity = new InspectionSubAssembly();
		$entity->setPhotos($randID);
		$this->assertTrue($entity->getPhotos() == $randID);
	}
	
	public function testGetMachineGeneralTest()
	{
		$randID = rand(100, 150);
		$entity = new InspectionSubAssembly();
		$entity->setMachineGeneralTest($randID);
		$this->assertTrue($entity->getMachineGeneralTest() == $randID);
	}
	
	public function testGetOilTest()
	{
		$randID = rand(100, 150);
		$entity = new InspectionSubAssembly();
		$entity->setOilTest($randID);
		$this->assertTrue($entity->getOilTest() == $randID);
	}
	
	public function testGetWearTest()
	{
		$randID = rand(100, 150);
		$entity = new InspectionSubAssembly();
		$entity->setWearTest($randID);
		$this->assertTrue($entity->getWearTest() == $randID);
	}
}