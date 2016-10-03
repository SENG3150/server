<?php

namespace Tests\Unit\App\API\V1\Entities;

use App\API\V1\Entities\MachineGeneralTest;
use TestCase;

class MachineGeneralTestTest extends TestCase
{
	public function testID()
	{
		$randID = rand(100,150);
		$entity = new MachineGeneralTest();
		$entity -> setId($randID);
		$this->assertTrue($entity->getId()==$randID);
	}

	public function testInspection()
	{
		$randID = rand(100,150);
		$entity = new MachineGeneralTest();
		$entity -> setInspection($randID);
		$this->assertTrue($entity->getInspection()==$randID);
	}

	public function testSubAssembly()
	{
		$randID = rand(100,150);
		$entity = new MachineGeneralTest();
		$entity -> setSubAssembly($randID);
		$this->assertTrue($entity->getSubAssembly()==$randID);
	}

	public function testActionItem()
	{
		$randID = rand(100,150);
		$entity = new MachineGeneralTest();
		$entity -> setActionItem($randID);
		$this->assertTrue($entity->getActionItem()==$randID);
	}

	public function testComments()
	{
		$randID = rand(100,150);
		$entity = new MachineGeneralTest();
		$entity -> setComments($randID);
		$this->assertTrue($entity->getComments()==$randID);
	}

	public function testPhotos()
	{
		$randID = rand(100,150);
		$entity = new MachineGeneralTest();
		$entity -> setPhotos($randID);
		$this->assertTrue($entity->getPhotos()==$randID);
	}
}