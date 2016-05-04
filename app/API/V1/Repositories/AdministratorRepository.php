<?php

namespace App\API\V1\Repositories;

use Doctrine\ORM\EntityRepository;

class AdministratorRepository extends EntityRepository
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