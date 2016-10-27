<?php

namespace Tests\Unit\App\API\V1\Entities;

use App\API\V1\Entities\ActionItem;
use Carbon\Carbon;
use TestCase;

class ActionItemTest extends TestCase
{
	public function testID()
	{
		$randID = rand(100, 150);
		$entity = new ActionItem();
		$entity->setId($randID);
		$this->assertTrue($entity->getId() == $randID);
	}
	
	public function testStatus()
	{
		$text   = str_random(10);
		$entity = new ActionItem();
		$entity->setStatus($text);
		$this->assertTrue($entity->getStatus() == $text);
	}
	
	public function testGetIssue()
	{
		$text   = str_random(10);
		$entity = new ActionItem();
		$entity->setIssue($text);
		$this->assertTrue($entity->getIssue() == $text);
	}
	
	public function testGetAction()
	{
		$text   = str_random(10);
		$entity = new ActionItem();
		$entity->setAction($text);
		$this->assertTrue($entity->getAction() == $text);
	}
	
	public function testGetTimeActioned()
	{
		$timeActioned = Carbon::create(rand(2009, 2016), rand(1, 12), rand(1, 28), rand(0, 23), rand(0, 59), rand(0, 59));
		$entity       = new ActionItem();
		$entity->setTimeActioned($timeActioned);
		$this->assertTrue($entity->getTimeActioned() == $timeActioned);
	}
	
	public function testGetMachineGeneralTest()
	{
		$randID = rand(100, 150);
		$entity = new ActionItem();
		$entity->setMachineGeneralTest($randID);
		$this->assertTrue($entity->getMachineGeneralTest() == $randID);
	}
	
	public function testGetOilTest()
	{
		$randID = rand(100, 150);
		$entity = new ActionItem();
		$entity->setOilTest($randID);
		$this->assertTrue($entity->getOilTest() == $randID);
	}
	
	public function testGetWearTest()
	{
		$randID = rand(100, 150);
		$entity = new ActionItem();
		$entity->setWearTest($randID);
		$this->assertTrue($entity->getWearTest() == $randID);
	}
	
	public function testGetTechnician()
	{
		$randID = rand(100, 150);
		$entity = new ActionItem();
		$entity->setTechnician($randID);
		$this->assertTrue($entity->getTechnician() == $randID);
	}
}