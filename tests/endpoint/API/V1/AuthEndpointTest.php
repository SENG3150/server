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

		$username  = str_random();
		$firstName = str_random();
		$lastName  = str_random();
		$email     = str_random() . '@' . str_random() . '.com';
		$password  = str_random();
		$token     = str_random();
		$temporary = FALSE;
		
		$headers['Authorization'] = 'Bearer ' . $this->getToken();

		$this
			->actingAsAdministrator()
			->json(
				'POST',
				'/technicians',
				[
					'username'  => $username,
					'firstName' => $firstName,
					'lastName'  => $lastName,
					'email'     => $email,
					'password'  => $password,
					'temporary' => $temporary,
				]
			)->assertResponseStatus(201);
		
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
			->assertResponseStatus(200);
		
		$this
			->setToken($token)
			->assertResponseStatus(200);
		
		$this
			->assertEquals($this->getToken(),$token);
	}
}