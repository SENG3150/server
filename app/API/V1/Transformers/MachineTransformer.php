<?php

namespace App\API\V1\Transformers;

use League\Fractal\TransformerAbstract;

use App\API\V1\Entities\Machine;

class MachineTransformer extends TransformerAbstract
{
	/**
	 * @var array
	 */
	protected $availableIncludes = array(
		'model',
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
	 * @param \App\API\V1\Entities\Machine $machine
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeModel(Machine $machine)
	{
		return $this->item($machine->getModel(), new ModelTransformer());
	}
}