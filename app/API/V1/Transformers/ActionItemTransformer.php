<?php

namespace App\API\V1\Transformers;

use League\Fractal\TransformerAbstract;

use App\API\V1\Entities\ActionItem;

class ActionItemTransformer extends TransformerAbstract
{
	/**
	 * @var array
	 */
	protected $availableIncludes = array(
		'machineGeneralTest',
		'oilTest',
		'wearTest',
		'technician',
	);

	/**
	 * @var array
	 */
	protected $defaultIncludes = array(
		'technician',
	);
	
	/**
	 * @param ActionItem $actionItem
	 *
	 * @return array
	 */
	public function transform(ActionItem $actionItem)
	{
		return array(
			'id'           => $actionItem->getId(),
			'status'       => $actionItem->getStatus(),
			'issue'        => $actionItem->getIssue(),
			'action'       => $actionItem->getAction(),
			'timeActioned' => $actionItem->getTimeActioned(),
		);
	}

	/**
	 * @param ActionItem $actionItem
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeMachineGeneralTest(ActionItem $actionItem)
	{
		return $this->item($actionItem->getMachineGeneralTest(), new MachineGeneralTestTransformer());
	}

	/**
	 * @param ActionItem $actionItem
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeOilTest(ActionItem $actionItem)
	{
		return $this->item($actionItem->getOilTest(), new OilTestTransformer());
	}

	/**
	 * @param ActionItem $actionItem
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeWearTest(ActionItem $actionItem)
	{
		return $this->item($actionItem->getWearTest(), new WearTestTransformer());
	}

	/**
	 * @param ActionItem $actionItem
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeTechnician(ActionItem $actionItem)
	{
		return $this->item($actionItem->getTechnician(), new TechnicianTransformer());
	}
}