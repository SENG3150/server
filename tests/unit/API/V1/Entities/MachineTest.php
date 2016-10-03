<?php

namespace Tests\Unit\App\API\V1\Entities;

use App\API\V1\Entities\Machine;
use TestCase;

class MachineTest extends TestCase
{
	public function testID()
	{
		$randID = rand(100,150);
		$entity = new Machine();
		$entity -> setId($randID);
		$this->assertTrue($entity->getId()==$randID);
	}

	public function testName()
	{
		$name = str_random(10);
		$entity = new Machine();
		$entity -> setName($name);
		$this->assertTrue($entity->getName()==$name);
	}

	public function testModel()
	{
		$randID = rand(100,150);
		$entity = new Machine();
		$entity -> setModel($randID);
		$this->assertTrue($entity->getModel()==$randID);
	}

	public function testInspections()
	{
		$randID = rand(100,150);
		$entity = new Machine();
		$entity -> setInspections($randID);
		$this->assertTrue($entity->getInspections()==$randID);
	}

	public function testDowntime()
	{
		$randID = rand(100,150);
		$entity = new Machine();
		$entity -> setDowntime($randID);
		$this->assertTrue($entity->getDowntime()==$randID);
	}
}