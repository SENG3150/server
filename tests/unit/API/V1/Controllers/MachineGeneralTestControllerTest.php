<?php

namespace Tests\Unit\App\API\V1\Controllers;

use TestCase;

/**
 * Class MachineGeneralTestControllerTest
 * @package Tests\Unit\App\API\V1\Controllers
 * @group   machineGeneralTestController
 * @group   controller
 */
class MachineGeneralTestControllerTest extends TestCase
{
	public function testGetList()
	{
		$this
			->actingAsAdministrator()
			->json('GET', '/machineGeneralTests')
			->seeJson(
				array(
					'authorType' => 'domainExpert',
					'status'     => 'OK',
				)
			);
	}
	
	public function testGet()
	{
		$this
			->actingAsAdministrator()
			->json('GET', '/machineGeneralTests/1')
			->seeJson(
				array(
					'authorType' => 'domainExpert',
					'status'     => 'OK',
				)
			);
	}
	
	public function testCreate()
	{
		$inspection  = 2;
		$subAssembly = 4;
		
		$this
			->actingAsAdministrator()
			->json(
				'POST',
				'/machineGeneralTests',
				[
					'inspection'  => $inspection,
					'subAssembly' => $subAssembly
				]
			)
			->assertResponseStatus(201);
	}
	
	public function testUpdate()
	{
		$actionItem = 4;
		
		$this
			->actingAsAdministrator()
			->json(
				'POST',
				'/machineGeneralTests/1',
				[
					'actionItem' => $actionItem
				]
			)
			->assertResponseStatus(202);
		
		$this
			->actingAsAdministrator()
			->json('GET', '/machineGeneralTests/1')
			->seeJson(
				[
					'timeActioned' => "2016-05-14T17:00:00+1000"
				]
			);
	}
	
	public function testDelete()
	{
		$this
			->actingAsAdministrator()
			->json('DELETE', '/machineGeneralTests/1')
			->assertResponseStatus(405);
	}
}