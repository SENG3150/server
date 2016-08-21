<?php

namespace App\API\V1\Repositories;

use Doctrine\ORM\EntityRepository;

class DowntimeRepository extends EntityRepository
{
    public function findByMachine($machine)
    {
        return $this->findBy(
            array(
                'machine' => $machine
            )
        );
    }
}