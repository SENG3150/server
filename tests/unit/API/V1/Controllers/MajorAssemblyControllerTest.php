<?php

namespace Tests\Unit\App\API\V1\Controllers;

use TestCase;

/**
 * Class MajorAssemblyControllerTest
 * @package Tests\Unit\App\API\V1\Controllers
 * @group   majorAssemblyController
 * @group   controller
 */
class MajorAssemblyControllerTest extends TestCase
{
	public function testGetList()
	{
		$this
			->actingAsAdministrator()
			->json('GET', '/majorAssemblies')
			->seeJson(
				[
					'name' => 'Hoist System (HST)'
				]
			);
	}
	
	public function testGet()
	{
		$this
			->actingAsAdministrator()
			->json('GET', '/majorAssemblies/1')
			->seeJson(
				[
					'name' => 'Hoist System (HST)'
				]
			);
	}
	
	public function testCreate()
	{
		$name    = str_random();
		$modelNo = 1;
		
		$this
			->actingAsAdministrator()->json(
				'POST',
				'/majorAssemblies',
				[
					'name'  => $name,
					'model' => $modelNo
				]
			)
			->assertResponseStatus(201);
	}
	
	public function testUpdate()
	{
		$name = str_random(10);
		$this
			->actingAsAdministrator()
			->json('POST', '/majorAssemblies/1',
			       [
				       'name' => $name
			       ]
			)
			->assertResponseStatus(202);
		
		$this
			->actingAsAdministrator()
			->json('GET', '/majorAssemblies/1')
			->seeJson(
				[
					'name' => $name
				]
			);
	}
	
	public function testDelete()
	{
		$this
			->actingAsAdministrator()
			->json('DELETE', 'majorAssemblies/1')
			->assertResponseStatus(202);
		
		$this
			->actingAsAdministrator()
			->json('GET', 'majorAssemblies/1')
			->assertResponseStatus(404);
	}
}