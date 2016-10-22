<?php

namespace Tests\Unit\App\API\V1\Controllers;

use TestCase;
use Carbon\Carbon;

/**
 * @group   inspectionController
 * @group   controller
 */
class InspectionControllerTest extends TestCase
{
	public function testGetList()
	{
		$this
			->actingAsDomainExpert()
		     ->json(
			     'GET',
			     '/inspections'
		     )
		     ->seeJson(
			     [
				     'timeCreated' => '2016-08-26T10:00:00+1000'
			     ]
		     );
	}
	
	public function testGet()
	{
		$this
			->actingAsDomainExpert()
		     ->json(
			     'GET',
			     '/inspections/1'
		     )
		     ->seeJson(
			     [
				     'timeCreated' => '2016-08-26T10:00:00+1000'
			     ]
		     );
	}
	
	public function testCreate()
	{
		$timeScheduled = Carbon::now()->format(DATE_ISO8601);
		$machineID     = 1;
		$techID        = 1;
		$schedulerID   = 1;
		
		$this
			->actingAsAdministrator()
			->json(
				'POST',
				'/inspections',
				[
					'timeScheduled'   => $timeScheduled,
					'machine'         => $machineID,
					'technician'      => $techID,
					'scheduler'       => $schedulerID,
					'majorAssemblies' => []
				]
			)
			->assertResponseStatus(201);
	}
	
	public function testUpdate()
	{
		$timeCompleted = Carbon::now()->format(DATE_ISO8601);
		
		$this
			->actingAsAdministrator()
			->json(
				'POST',
				'/inspections/1',
				[
					'timeCompleted' => $timeCompleted
				]
			)
			->assertResponseStatus(202);
	}
	
	public function testDelete()
	{
		$this
			->actingAsAdministrator()
			->json('DELETE', '/inspections/1')
			->assertResponseStatus(202);
		
		$this
			->actingAsAdministrator()
			->json('GET', '/inspections/1')
			->assertResponseStatus(404);
	}
	
	public function testGetIncompleteList()
	{
		$this
			->actingAsAdministrator()
			->json('GET', 'inspections/incomplete')
			->seeJson(
				[
					'timeCompleted' => NULL
				]
			);
	}
}