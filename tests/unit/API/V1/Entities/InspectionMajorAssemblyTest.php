<?php

namespace Tests\Unit\App\API\V1\Entities;

use App\API\V1\Entities\InspectionMajorAssembly;
use TestCase;

class InspectionMajorAssemblyTest extends TestCase
{

	public function testID()
	{
		$randID = rand(100,150);
		$entity = new InspectionMajorAssembly();
		$entity -> setId($randID);
		$this->assertTrue($entity->getId()==$randID);
	}

	public function testInspection()
	{
		$randID = rand(100,150);
		$entity = new InspectionMajorAssembly();
		$entity -> setInspection($randID);
		$this->assertTrue($entity->getInspection()==$randID);
	}

	public function testMajorAssembly()
	{
		$randID = rand(100,150);
		$entity = new InspectionMajorAssembly();
		$entity -> setMajorAssembly($randID);
		$this->assertTrue($entity->getMajorAssembly()==$randID);
	}
	
	public function testSubAssemblies()
	{
		$randID = rand(100,150);
		$entity = new InspectionMajorAssembly();
		$entity -> setSubAssemblies($randID);
		$this->assertTrue($entity->getSubAssemblies()==$randID);
	}

	public function testComments()
	{
		$randID = rand(100,150);
		$entity = new InspectionMajorAssembly();
		$entity -> setComments($randID);
		$this->assertTrue($entity->getComments()==$randID);
	}

	public function testPhotos()
	{
		$randID = rand(100,150);
		$entity = new InspectionMajorAssembly();
		$entity -> setPhotos($randID);
		$this->assertTrue($entity->getPhotos()==$randID);
	}
}