<?php

namespace Tests\Unit\App\API\V1\Entities;

use App\API\V1\Entities\WearTest;
use TestCase;

class WearTestTest extends TestCase
{
	public function testID()
	{
		$randID = rand(100, 150);
		$entity = new WearTest();
		$entity->setId($randID);
		$this->assertTrue($entity->getId() == $randID);
	}
	
	public function testInspection()
	{
		$randID = rand(100, 150);
		$entity = new WearTest();
		$entity->setInspection($randID);
		$this->assertTrue($entity->getInspection() == $randID);
	}
	
	public function testSubAssembly()
	{
		$randID = rand(100, 150);
		$entity = new WearTest();
		$entity->setSubAssembly($randID);
		$this->assertTrue($entity->getSubAssembly() == $randID);
	}
	
	public function testActionItem()
	{
		$randID = rand(100, 150);
		$entity = new WearTest();
		$entity->setActionItem($randID);
		$this->assertTrue($entity->getActionItem() == $randID);
	}
	
	public function testComments()
	{
		$randID = rand(100, 150);
		$entity = new WearTest();
		$entity->setComments($randID);
		$this->assertTrue($entity->getComments() == $randID);
	}
	
	public function testPhotos()
	{
		$randID = rand(100, 150);
		$entity = new WearTest();
		$entity->setPhotos($randID);
		$this->assertTrue($entity->getPhotos() == $randID);
	}
	
	public function testSmu()
	{
		$smu    = rand(100, 150);
		$entity = new WearTest();
		$entity->setSmu($smu);
		$this->assertTrue($entity->getSmu() == $smu);
	}
	
	public function testUniqueDetails()
	{
		$uniqueDetails = str_random(10);
		$entity        = new WearTest();
		$entity->setUniqueDetails($uniqueDetails);
		$this->assertTrue($entity->getUniqueDetails() == $uniqueDetails);
	}
}