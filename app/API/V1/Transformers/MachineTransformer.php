<?php

namespace App\API\V1\Transformers;

use App\API\V1\Entities\Machine;

class MachineTransformer extends Transformer
{
	/**
	 * @var array
	 */
	protected $availableIncludes = array(
		'model',
		'inspections',
		'downtime',
	);

	/**
	 * @var array
	 */
	protected $defaultIncludes = array(
		'model',
	);
	
	/**
	 * @param Machine $machine
	 *
	 * @return array
	 */
	public function transform(Machine $machine)
	{
		return array(
			'id'   => $machine->getId(),
			'name' => $machine->getName(),
		);
	}

	/**
	 * @param Machine $machine
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeModel(Machine $machine)
	{
		return $this->item($machine->getModel(), new ModelTransformer());
	}

	/**
	 * @param Downtime $downtime
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeDowntime(Downtime $downtime)
	{
		return $this->item($downtime->getModel(), new DowntimeTransformer());
	}

	/**
	 * @param Machine $machine
	 *
	 * @return \League\Fractal\Resource\Collection
	 */
	public function includeInspections(Machine $machine)
	{
		return $this->collection($machine->getInspections(), new InspectionTransformer());
	}
}