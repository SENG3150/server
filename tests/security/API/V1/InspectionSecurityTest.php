<?php

namespace Tests\Security\App\API\V1;

use TestCase;

class InspectionSecurityTest extends TestCase
{
	public function testAnonymousAccess()
	{
		$this
			->json(
				'GET',
				'/inspections'
			)
			->assertResponseStatus(401);
	}
	
	public function testAdministratorAccess()
	{
		// This test should fail as there are no access control mechanisms in place that would prevent an administrator from viewing inspections
		
		$this
			->actingAsAdministrator()
			->json(
				'GET',
				'/inspections'
			)
			->assertResponseStatus(401);
	}
	
	public function testDomainExpertAccess()
	{
		$this
			->actingAsDomainExpert()
			->json(
				'GET',
				'/inspections'
			)
			->assertResponseStatus(200);
	}
	
	public function testTechnicianAccess()
	{
		$this
			->actingAsTechnician()
			->json(
				'GET',
				'/inspections'
			)
			->assertResponseStatus(200);
	}
	
	public function testInspectionAccess()
	{
		// This test should fail as there are no access control mechanisms in place that would prevent a technician from viewing another technician's inspection
		
		// Grab another technician
		$technician = app('TechnicianRepository')->find(1);
		
		$this
			->actingAsTechnician($technician)
			->json(
				'GET',
				'/inspections/1' // Belongs to technician 1
			)
			->assertResponseStatus(200);
		
		// Grab another technician
		$technician = app('TechnicianRepository')->find(2);
		
		$this
			->actingAsTechnician($technician)
			->json(
				'GET',
				'/inspections/1' // Belongs to technician 1
			)
			->assertResponseStatus(401);
	}
}