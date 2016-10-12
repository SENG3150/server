<?php

namespace Tests\Database\App\API\V1;

use App\API\V1\Entities\Model;
use TestCase;

class ModelDatabaseTest extends TestCase
{
	public function testDuplicateId()
	{
		$model = new Model();
		
		$model
			->setId(1)
			->setName('Test');
		
		$this->em->persist($model);
		$this->em->flush();
		
		$this->fail('The ORM should prevent the system from adding a duplicate model with the same id, but as the ORM treats this as a simple update to the existing model with id 1, the test runs successfully - this is expected behaviour.');
	}
}