<?php

namespace App\API\V1\Repositories;

use App\Repositories\Repository;

class DowntimeRepository extends Repository
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