<?php

namespace Tests\Unit\App\API\V1\Controllers;

use TestCase;

/**
 * @group   oilTestController
 * @group   controller
 */
class OilTestControllerTest extends TestCase
{
	public function testGetList()
	{
		$this
			->actingAsAdministrator()
			->json('GET', '/oilTests')
			->seeJson(
				[
					'lead'   => 1,
					'copper' => 2,
					'tin'    => 3,
				]
			);
	}
	
	public function testGet()
	{
		$this
			->actingAsAdministrator()
		     ->json('GET', '/oilTests/1')
		     ->seeJson(
			     [
				     'lead'   => 1,
				     'copper' => 2,
				     'tin'    => 3,
			     ]
		     );
	}
	
	public function testCreate()
	{
		$inspection  = 1;
		$subAssembly = 2;
		$lead        = random_int(0, 100);
		$copper      = random_int(0, 100);
		$tin         = random_int(0, 100);
		$iron        = random_int(0, 100);
		$pq90        = random_int(0, 100);
		$silicon     = random_int(0, 100);
		$sodium      = random_int(0, 100);
		$aluminium   = random_int(0, 100);
		$water       = random_int(0, 100) / 10;
		$viscosity   = random_int(0, 100);
		
		$this
			->actingAsAdministrator()
			->json('POST',
			       '/oilTests',
			       array(
				       'inspection'  => $inspection,
				       'subAssembly' => $subAssembly,
				       'lead'        => $lead,
				       'copper'      => $copper,
				       'tin'         => $tin,
				       'iron'        => $iron,
				       'pq90'        => $pq90,
				       'silicon'     => $silicon,
				       'sodium'      => $sodium,
				       'aluminium'   => $aluminium,
				       'water'       => $water,
				       'viscosity'   => $viscosity
			       )
			)
			->assertResponseStatus(201);
	}
	
	public function testUpdate()
	{
		$copper = random_int(0, 100);
		
		$this
			->actingAsAdministrator()
			->json('POST', '/oilTests/1',
			       [
				       'copper' => $copper
			
			       ]
			)
			->assertResponseStatus(202);
		
		$this
			->actingAsAdministrator()
			->json('GET', '/oilTests/1')
			->seeJson(
				[
					'copper' => $copper,
				]
			);
	}
	
	public function testDelete()
	{
		$this
			->actingAsAdministrator()
			->json('DELETE', '/oilTests/1')
			->assertResponseStatus(405);
	}
}