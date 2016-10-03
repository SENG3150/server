<?php

namespace Tests\Unit\App\API\V1\Entities;

use App\API\V1\Entities\Model;
use TestCase;

class ModelTest extends TestCase
{
	public function testID()
	{
		$randID = rand(100,150);
		$entity = new Model();
		$entity -> setId($randID);
		$this->assertTrue($entity->getId()==$randID);
	}

	public function testName()
	{
		$name = str_random(10);
		$entity = new Model();
		$entity -> setName($name);
		$this->assertTrue($entity->getName()==$name);
	}

	public function testMajorAssemblies()
	{
		$randID = rand(100,150);
		$entity = new Model();
		$entity -> setMajorAssemblies($randID);
		$this->assertTrue($entity->getMajorAssemblies()==$randID);
	}



	public function testMachines()
	{
		$randID = rand(100,150);
		$entity = new Model();
		$entity -> setMachines($randID);
		$this->assertTrue($entity->getMachines()==$randID);
	}
}