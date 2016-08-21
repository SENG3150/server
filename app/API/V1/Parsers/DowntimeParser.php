<?php
namespace App\API\V1\Parsers;

use App\API\V1\Entities\Downtime as Entity;
use App\API\V1\Repositories\DowntimeRepository as Repository;
use Illuminate\Http\Request;
use App;

class DowntimeParser extends Parser {

    /** @var Repository $repository */
    var $repository;

    public function create($input, $recursive = TRUE)
    {
        $input = $this->resolveInput($input);

        $this->validateArray(
            $input,
            array(
                'downTimeHours'          => 'required',
                'reason' => 'required|',
            )
        );
        $machineType=null;
        $machine = $this->resolveOne(
            $input,
            array(
                'machine' => App\API\V1\Repositories\MachineRepository::class,

            ), $machineType
        );
        if($machineType == NULL)
        {
            throw new \Dingo\Api\Exception\ValidationHttpException(
                array(
                    'machine' => 'No machine was set.'
                )
            );
        }
        $entity = new Entity();
        $this->resolve($entity, $input, 'reason');
        $this->resolve($entity, $input, 'downTimeHours');
        $entity->setMachine($machine);
    }
}
