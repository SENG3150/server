<?php

namespace App\API\V1\Transformers;

use App\API\V1\Entities\MachineGeneralTest;
use App\Transformers\Transformer;

class MachineGeneralTestTransformer extends Transformer
{
	/**
	 * @var array
	 */
	protected $availableIncludes = array(
		'inspection',
		'subAssembly',
		'comments',
		'photos',
		'actionItem',
	);

	/**
	 * @var array
	 */
	protected $defaultIncludes = array(
		'comments',
		'photos',
		'actionItem',
	);
	
	/**
	 * @param MachineGeneralTest $machineGeneralTest
	 *
	 * @return array
	 */
	public function transform(MachineGeneralTest $machineGeneralTest)
	{
		return array(
			'id'       => $machineGeneralTest->getId(),
			'testType' => $machineGeneralTest->getTestType(),
			'docLink'  => $machineGeneralTest->getDocLink(),
		);
	}

	/**
	 * @param MachineGeneralTest $machineGeneralTest
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeInspection(MachineGeneralTest $machineGeneralTest)
	{
		return $this->item($machineGeneralTest->getInspection(), new InspectionTransformer());
	}

	/**
	 * @param MachineGeneralTest $machineGeneralTest
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeSubAssembly(MachineGeneralTest $machineGeneralTest)
	{
		return $this->item($machineGeneralTest->getSubAssembly(), new InspectionSubAssemblyTransformer());
	}

	/**
	 * @param MachineGeneralTest $machineGeneralTest
	 *
	 * @return \League\Fractal\Resource\Collection
	 */
	public function includeComments(MachineGeneralTest $machineGeneralTest)
	{
		return $this->collection($machineGeneralTest->getComments(), new CommentTransformer());
	}

	/**
	 * @param MachineGeneralTest $machineGeneralTest
	 *
	 * @return \League\Fractal\Resource\Collection
	 */
	public function includePhotos(MachineGeneralTest $machineGeneralTest)
	{
		return $this->collection($machineGeneralTest->getPhotos(), new PhotoTransformer());
	}

	/**
	 * @param MachineGeneralTest $machineGeneralTest
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeActionItem(MachineGeneralTest $machineGeneralTest)
	{
		return $this->item($machineGeneralTest->getActionItem(), new ActionItemTransformer());
	}
}