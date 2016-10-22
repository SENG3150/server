<?php

namespace Tests\Unit\App\API\V1\Controllers;

use Carbon\Carbon;
use TestCase;

/**
 * @group   commentController
 * @group   controller
 */
class CommentControllerTest extends TestCase
{
	public function testGetList()
	{
		$this
			->actingAsTechnician()
			->json('GET', '/comments')
			->seeJson(
				array(
					'text' => 'Test comment.'
				)
			);
	}
	
	public function testGet()
	{
		$this
			->actingAsTechnician()
			->json('GET', '/comments/1')
			->seeJson(
				array(
					'text' => 'Test comment.'
				)
			);
	}
	
	public function testGetNotFound()
	{
		$this
			->actingAsDomainExpert()
			->json('GET', '/comments/0')
			->assertResponseStatus(404);
	}
	
	public function testCreate()
	{
		$text          = str_random();
		$timeCommented = Carbon::now()->format(DATE_ISO8601);
		
		$this
			->actingAsTechnician()
			->json(
				'POST',
				'/comments',
				[
					'text'          => $text,
					'timeCommented' => $timeCommented,
					'technician'    => 1,
					'inspection'    => 1
				]
			)
			->assertResponseStatus(201);
	}
	
	public function testCreateNoAuthor()
	{
		$text          = str_random();
		$timeCommented = Carbon::now()->format(DATE_ISO8601);
		
		$this
			->actingAsTechnician()
			->json(
				'POST',
				'/comments',
				[
					'text'          => $text,
					'timeCommented' => $timeCommented,
				]
			)
			->assertResponseStatus(422);
	}
	
	public function testDelete()
	{
		$this->actingAsAdministrator()
		     ->json('DELETE', '/comments/1')
		     ->assertResponseStatus(405);
	}
}