<?php

namespace App\API\V1\Controllers;

use App\API\V1\Repositories\MachineRepository;
use App\API\V1\Transformers\MachineTransformer;
use Illuminate\Support\Collection;

class MachineController extends APIController
{
	public function getList(MachineRepository $machineRepository)
	{
		$machines = $machineRepository->findAll();

		return $this->response->collection(Collection::make($machines), new MachineTransformer());
	}

	public function get($machineId, MachineRepository $machineRepository)
	{
		$machine = $machineRepository->find($machineId);

		return $this->response->item($machine, new MachineTransformer());
	}
}