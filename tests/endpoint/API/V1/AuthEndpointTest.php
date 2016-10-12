<?php

namespace Tests\Endpoint\App\API\V1;

use TestCase;

class AuthEndpointTest extends TestCase
{
	public function testValidCredentials()
	{
		$this
			->json(
				'POST',
				'/auth/authenticate',
				[
					'type'     => 'technician',
					'username' => 'technician',
					'password' => 'technician',
				]
			)
			->assertResponseStatus(200)
			->seeJsonStructure(
				array(
					'token',
				)
			);
	}
	
	public function testInvalidCredentials()
	{
		$this
			->json(
				'POST',
				'/auth/authenticate',
				[
					'type'     => 'technician',
					'username' => 'technician',
					'password' => 'wrongpassword',
				]
			)
			->assertResponseStatus(401)
			->seeJson(
				array(
					'error' => 'invalid_credentials',
				)
			);
	}
	
	public function testMissingCredentials()
	{
		$this
			->json(
				'POST',
				'/auth/authenticate',
				[
					'type'     => 'technician',
					'username' => 'technician',
				]
			)
			->assertResponseStatus(401)
			->seeJson(
				array(
					'error' => 'invalid_credentials',
				)
			);
	}
	
	public function testDuplicateCredentials()
	{
		$this
			->json(
				'POST',
				'/auth/authenticate',
				[
					'type'     => 'technician',
					'username' => 'technician',
					'username' => 'technician',
					'password' => 'technician',
				]
			)
			->assertResponseStatus(200)
			->seeJsonStructure(
				array(
					'token',
				)
			);
	}
	
	public function testCreateTechnicianAndLogin()
	{
		// TODO: Write a test that will create a random technician in one call, then authenticate as that technician in another call, and finally call GET /auth/me to verify that the token is working
		
		// For the final call you will need to manually set the Authorization header, for an example check \tests\TestCase.php line 162, or ask Mitchell
	}
}