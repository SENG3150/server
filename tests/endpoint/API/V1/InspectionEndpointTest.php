<?php

namespace Tests\Endpoint\App\API\V1;

use TestCase;

class InspectionEndpointTest extends TestCase
{
	public function testBulkCreate()
	{
		$this
			->actingAsTechnician()
			->json(
				'POST',
				'/inspections/bulk',
				[
					// TODO: Fill in valid JSON to make an inspection
				]
			)
			->assertResponseStatus(200)
			->seeJsonStructure(
				array(
					// TODO: Refill in previous JSON to verify inspection details were correct
				)
			);
	}
	
	public function testBulkUpdate()
	{
		$this
			->actingAsTechnician()
			->json(
				'POST',
				'/inspections/bulk',
				[
					// TODO: Fill in valid JSON to update an inspection
				]
			)
			->assertResponseStatus(200)
			->seeJsonStructure(
				array(
					// TODO: Refill in previous JSON to verify inspection details were correct
				)
			);
	}
}