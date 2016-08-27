<?php

namespace App\API\V1\Repositories;

use App\Repositories\Repository;

class DomainExpertRepository extends Repository
{
	public function findOneByUsername($username)
	{
		return $this->findOneBy(
			array(
				'username' => $username
			)
		);
	}
}