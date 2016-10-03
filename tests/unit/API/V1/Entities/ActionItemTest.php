<?php

namespace Tests\Unit\App\API\V1\Entities;

use App\API\V1\Entities\ActionItem;
use Carbon\Carbon;
use TestCase;

class ActionItemTest extends TestCase
{

	public function testID()
	{
		$randID = rand(100,150);
		$entity = new ActionItem();
		$entity -> setId($randID);
		$this->assertTrue($entity->getId()==$randID);
	}

	/**
	 * @return string
	 */
	public function testStatus()
	{
		$status = str_random(10);

		$this
			->actingAsDomainExpert()
			->json(
				'POST',
				'/actionItems/1',
				[
					'status' => $status,
				]
			)
			->assertResponseStatus(202);

		$this
			->actingAsDomainExpert()
			->json(
				'GET',
				'/actionItems/1'
			)
			->seeJson(
				array(
					'status' => $status,
				)
			);
	}

	/**
	 * @return string
	 */
	public function testGetIssue()
	{
		$issue = str_random(10);

		$this
			->actingAsDomainExpert()
			->json(
				'POST',
				'/actionItems/1',
				[
					'issue' => $issue,
				]
			)
			->assertResponseStatus(202);

		$this
			->actingAsDomainExpert()
			->json(
				'GET',
				'/actionItems/1'
			)
			->seeJson(
				array(
					'issue' => $issue,
				)
			);
	}

	/**
	 * @return string
	 */
	public function testGetAction()
	{
		$action = str_random(10);

		$this
			->actingAsDomainExpert()
			->json(
				'POST',
				'/actionItems/1',
				[
					'action' => $action,
				]
			)
			->assertResponseStatus(202);

		$this
			->actingAsDomainExpert()
			->json(
				'GET',
				'/actionItems/1'
			)
			->seeJson(
				array(
					'action' => $action,
				)
			);
	}

	/**
	 * @return \DateTime
	 */
	public function testGetTimeActioned()
	{
		$year = rand(2009, 2016);
		$month = rand(1, 12);
		$day = rand(1, 28);
		$hour = rand(0, 23);
		$minute = rand(0, 59);
		$second = rand(0, 59);

		$timeActioned = Carbon::create($year,$month ,$day , $hour, $minute, $second)->format(DATE_ISO8601);


		$this
			->actingAsDomainExpert()
			->json(
				'POST',
				'/actionItems/1',
				[
					'timeActioned' => $timeActioned,
				]
			)
			->assertResponseStatus(202);

		$this
			->actingAsDomainExpert()
			->json(
				'GET',
				'/actionItems/1'
			)
			->seeJson(
				array(
					'timeActioned' => $timeActioned,
				)
			);
	}


	/**
	 * @return \App\API\V1\Entities\MachineGeneralTest
	*/
	public function testGetMachineGeneralTest()
	{
		$randID = rand(100,150);
		$entity = new ActionItem();
		$entity -> setMachineGeneralTest($randID);
		$this->assertTrue($entity->getMachineGeneralTest()==$randID);
	}

	/**
	 * @return \App\API\V1\Entities\OilTest
	 */
	public function testGetOilTest()
	{
		$randID = rand(100,150);
		$entity = new ActionItem();
		$entity -> setOilTest($randID);
		$this->assertTrue($entity->getOilTest()==$randID);
	}

	/**
	 * @return \App\API\V1\Entities\WearTest
	 */
	public function testGetWearTest()
	{
		$randID = rand(100,150);
		$entity = new ActionItem();
		$entity -> setWearTest($randID);
		$this->assertTrue($entity->getWearTest()==$randID);
	}

	/**
	 * @return \App\API\V1\Entities\Technician
	 */
	public function testGetTechnician()
	{
		$randID = rand(100,150);
		$entity = new ActionItem();
		$entity -> setTechnician($randID);
		$this->assertTrue($entity->getTechnician()==$randID);

	}/**/
}