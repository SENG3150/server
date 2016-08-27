<?php

namespace App\API\V1\Repositories;

use App\Repositories\Repository;

class AdministratorRepository extends Repository
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