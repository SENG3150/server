<?php

namespace Tests\Unit\App\API\V1\Controllers;

use TestCase;

/**
 * @group   downtimeController
 * @group   controller
 */
class DowntimeControllerTest extends TestCase
{
	public function testGetList()
	{
		$this
			->actingAsDomainExpert()
			->json('GET', '/downtime')
			->seeJson(
				array(
					'systemName' => 'S343'
				)
			);
	}
	
	public function testGet()
	{
		$this
			->actingAsDomainExpert()
			->json('GET', '/downtime/1')
			->seeJson(
				array(
					'systemName' => 'S343'
				)
			);
	}
	
	public function testCreate()
	{
		$system      = str_random();
		$downtimeHrs = random_int(0, 1000 / 10);
		$reason      = str_random();
		$this
			->actingAsDomainExpert()
			->json(
				'POST',
				'/downtime',
				[
					'systemName'    => $system,
					'downTimeHours' => $downtimeHrs,
					'reason'        => $reason,
					'machine'       => 1
				]
			)
			->assertResponseStatus(201);
	}
	
	public function testCreateWithoutReason()
	{
		$system      = str_random();
		$downtimeHrs = (random_int(0, 1000) / 10);
		
		$this
			->actingAsDomainExpert()
			->json(
				'POST',
				'/downtime',
				[
					'systemName'    => $system,
					'downTimeHours' => $downtimeHrs,
					'machine'       => 1
				]
			)->assertResponseStatus(201);
	}
	
	public function testUpdate()
	{
		$system      = str_random();
		$downtimeHrs = (random_int(0, 1000) / 10);
		
		$this
			->actingAsDomainExpert()
			->json(
				'POST',
				'/downtime/1',
				[
					'systemName'    => $system,
					'downTimeHours' => $downtimeHrs,
				]
			)
			->assertResponseStatus(202);
		
		$this
			->actingAsDomainExpert()
			->json
			(
				"GET",
				"/downtime/1"
			)
			->seeJson(
				array(
					'systemName'    => $system,
					'downTimeHours' => $downtimeHrs,
				)
			);
	}
	
	public function testDelete()
	{
		$this
			->actingAsAdministrator()
			->json('DELETE', '/downtime/1')
			->assertResponseStatus(405);
	}
	
	public function testCreateBulk()
	{
		$downtimeArray = array();
		
		for($i = 0; $i < 100; $i++)
		{
			$system      = str_random();
			$downtimeHrs = random_int(0, 1000 / 10);
			$reason      = str_random();
			$downtime    =
				[
					'systemName'    => $system,
					'downTimeHours' => $downtimeHrs,
					'reason'        => $reason,
					'machine'       => 1
				
				];
			array_push($downtimeArray, $downtime);
		}
		
		$this
			->actingAsDomainExpert()
			->json(
				'POST',
				'/downtime/bulk',
				$downtimeArray
			)
			->assertResponseStatus(201);
	}
}