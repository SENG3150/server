<?php

namespace Tests\Unit\App\API\V1\Controllers;

use TestCase;

class WearTestControllerTest extends TestCase
{
	public function testGetList()
	{
		$this
			->actingAsAdministrator()
			->json('GET', '/wearTests')
			->seeJson(
				[
					'smu'     => 0,
					'Field 1' => 'Value 1',
					'Field 2' => 'Value 2'
				]
			);
	}
	
	public function testGet()
	{
		$this
			->actingAsAdministrator()
			->json('GET', '/wearTests/1')
			->seeJson(
				[
					'smu'     => 0,
					'Field 1' => 'Value 1',
					'Field 2' => 'Value 2'
				]
			);
	}
	
	public function testCreate()
	{
		$inspection  = 2;
		$subAssembly = 2;
		$smu         = random_int(0, 100);
		
		$this
			->actingAsAdministrator()
			->json(
				'POST',
				'/wearTests',
				array(
					'inspection'  => $inspection,
					'subAssembly' => $subAssembly,
					'smu'         => $smu
				)
			)
			->assertResponseStatus(201);
	}
	
	public function testUpdate()
	{
		$inspection  = 2;
		$subAssembly = 2;
		$smu         = random_int(0, 100);
		
		$this
			->actingAsAdministrator()
			->json(
				'POST',
				'/wearTests/1',
				array(
					'inspection'  => $inspection,
					'subAssembly' => $subAssembly,
					'smu'         => $smu
				)
			)->assertResponseStatus(202);
		
		$this
			->actingAsAdministrator()
			->json('GET', '/wearTests/1')
			->seeJson(
				[
					'smu' => $smu,
				]
			);
	}
	
	public function testDelete()
	{
		$this
			->actingAsAdministrator()
			->json('DELETE', '/wearTests/1')
			->assertResponseStatus(405);
	}
}