<?php

namespace Tests\Security\App\API\V1;

use TestCase;

class AdministratorSecurityTest extends TestCase
{
	public function testAnonymousAccess()
	{
		$this
			->json(
				'GET',
				'/administrators'
			)
			->assertResponseStatus(401);
	}
	
	public function testAdministratorAccess()
	{
		$this
			->actingAsAdministrator()
			->json(
				'GET',
				'/administrators'
			)
			->assertResponseStatus(200);
	}
	
	public function testDomainExpertAccess()
	{
		// This test should fail as there are no access control mechanisms in place that would prevent a domain expert from viewing administrators
		
		$this
			->actingAsDomainExpert()
			->json(
				'GET',
				'/administrators'
			)
			->assertResponseStatus(401);
	}
	
	public function testTechnicianAccess()
	{
		// This test should fail as there are no access control mechanisms in place that would prevent a technician from viewing administrators
		
		$this
			->actingAsTechnician()
			->json(
				'GET',
				'/administrators'
			)
			->assertResponseStatus(401);
	}
}