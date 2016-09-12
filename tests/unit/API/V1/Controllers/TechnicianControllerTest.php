<?php

namespace Tests\Unit\App\API\V1\Controllers;

use TestCase;

class TechnicianControllerTest extends TestCase
{
	public function testGetList()
	{
		$this
			->actingAsTechnician()
			->json('GET', '/technicians')
			->seeJson(
				array(
					'name' => 'Technician Technician'
				)
			);
	}
	
	public function testGet()
	{
		$this
			->actingAsTechnician()
			->json('GET', '/technicians/1')
			->seeJson(
				array(
					'name' => 'Technician Technician'
				)
			);
	}
	
	public function testCreate()
	{
		$username  = str_random();
		$firstName = str_random();
		$lastName  = str_random();
		$email     = str_random() . '@' . str_random() . '.com';
		$password  = str_random();
		$temporary = FALSE;
		
		$this
			->actingAsDomainExpert()
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
			)
			->assertResponseStatus(201);
	}
	
	public function testDuplicateUsername()
	{
		$username  = str_random();
		$firstName = str_random();
		$lastName  = str_random();
		$email     = str_random() . '@' . str_random() . '.com';
		$password  = str_random();
		$temporary = FALSE;
		
		$this
			->actingAsDomainExpert()
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
			)
			->assertResponseStatus(201);
		
		$this
			->actingAsDomainExpert()
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
			)
			->assertResponseStatus(422)
			->seeJson(
				array(
					'errors' => array(
						'username' => array(
							'This username is already registered.'
						)
					)
				)
			);
	}
	
	public function testUpdate()
	{
		$firstName = str_random(10);
		$lastName  = str_random(10);
		
		$this
			->actingAsDomainExpert()
			->json(
				'POST',
				'/technicians/1',
				[
					'firstName' => $firstName,
					'lastName'  => $lastName,
				]
			)
			->assertResponseStatus(202);
		
		$this
			->actingAsDomainExpert()
			->json(
				'GET',
				'/technicians/1'
			)
			->seeJson(
				array(
					'firstName' => $firstName,
					'lastName'  => $lastName,
				)
			);
	}
}