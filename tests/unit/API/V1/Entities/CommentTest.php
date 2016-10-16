<?php

namespace Tests\Unit\App\API\V1\Entities;

use App\API\V1\Entities\Comment;
use Carbon\Carbon;
use TestCase;

class CommentTest extends TestCase
{
	
	public function testID()
	{
		$randID = rand(100, 150);
		$entity = new Comment();
		$entity->setId($randID);
		$this->assertTrue($entity->getId() == $randID);
	}
	
	public function testText()
	{
		$text   = str_random(10);
		$entity = new Comment();
		$entity->setText($text);
		$this->assertTrue($entity->getText() == $text);
	}
	
	public function testTimeCommented()
	{
		$timeCommented = Carbon::create(rand(2009, 2016), rand(1, 12), rand(1, 28), rand(0, 23), rand(0, 59), rand(0, 59));
		$entity        = new Comment();
		$entity->setTimeCommented($timeCommented);
		$this->assertTrue($entity->getTimeCommented() == $timeCommented);
	}
	
	public function testInspection()
	{
		$randID = rand(100, 150);
		$entity = new Comment();
		$entity->setInspection($randID);
		$this->assertTrue($entity->getInspection() == $randID);
	}
	
	public function testMajorAssembly()
	{
		$randID = rand(100, 150);
		$entity = new Comment();
		$entity->setMajorAssembly($randID);
		$this->assertTrue($entity->getMajorAssembly() == $randID);
	}
	
	public function testSubAssembly()
	{
		$randID = rand(100, 150);
		$entity = new Comment();
		$entity->setSubAssembly($randID);
		$this->assertTrue($entity->getSubAssembly() == $randID);
	}
	
	public function testMachineGeneralTest()
	{
		$randID = rand(100, 150);
		$entity = new Comment();
		$entity->setMachineGeneralTest($randID);
		$this->assertTrue($entity->getMachineGeneralTest() == $randID);
	}
	
	public function testOilTest()
	{
		$randID = rand(100, 150);
		$entity = new Comment();
		$entity->setOilTest($randID);
		$this->assertTrue($entity->getOilTest() == $randID);
	}
	
	public function testWearTest()
	{
		$randID = rand(100, 150);
		$entity = new Comment();
		$entity->setWearTest($randID);
		$this->assertTrue($entity->getWearTest() == $randID);
	}
	
	public function testTechnician()
	{
		$randID = rand(100, 150);
		$entity = new Comment();
		$entity->setTechnician($randID);
		$this->assertTrue($entity->getTechnician() == $randID);
	}
	
	public function testDomainExpert()
	{
		$randID = rand(100, 150);
		$entity = new Comment();
		$entity->setDomainExpert($randID);
		$this->assertTrue($entity->getDomainExpert() == $randID);
	}
}