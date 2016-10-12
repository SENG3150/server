<?php

namespace Tests\Endpoint\App\API\V1;

use TestCase;

class PhotoEndpointTest extends TestCase
{
	public function testInvalidBase64()
	{
		$this
			->actingAsTechnician()
			->json(
				'POST',
				'/photos',
				[
					'inspection' => 1,
					'technician' => 1,
					'format'     => 'jpeg',
					'photo'      => 'VGhpcyBpcyBhbiBlbmNvZGVkIHN0cmluZ=', // Invalid base64
				]
			)
			->assertResponseStatus(422)
			->seeJson(
				array(
					'errors' => array(
						'photo' => array(
							'The photo was not valid base64.',
						)
					)
				)
			);
	}
	
	public function testPostAndRetrieve()
	{
		// TODO: Post a photo to the server and then retrieve it and verify that the image contents match
	}
}