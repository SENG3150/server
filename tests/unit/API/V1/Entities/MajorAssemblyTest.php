<?php

namespace Tests\Unit\App\API\V1\Entities;

use App\API\V1\Entities\MajorAssembly;
use TestCase;

class MajorAssemblyTest extends TestCase
{
	public function testID()
	{
		$randID = rand(100,150);
		$entity = new MajorAssembly();
		$entity -> setId($randID);
		$this->assertTrue($entity->getId()==$randID);
	}

	public function testName()
	{
		$name = str_random(10);
		$entity = new MajorAssembly();
		$entity -> setName($name);
		$this->assertTrue($entity->getName()==$name);
	}

	public function testModel()
	{
		$randID = rand(100,150);
		$entity = new MajorAssembly();
		$entity -> setModel($randID);
		$this->assertTrue($entity->getModel()==$randID);
	}

	public function testSubAssemblies()
	{
		$randID = rand(100,150);
		$entity = new MajorAssembly();
		$entity -> setSubAssemblies($randID);
		$this->assertTrue($entity->getSubAssemblies()==$randID);
	}
}