<?php

namespace App\API\V1\Transformers;

use League\Fractal\TransformerAbstract;

use App\API\V1\Entities\MachineGeneralTest;

class MachineGeneralTestTransformer extends TransformerAbstract
{
	/**
	 * @var array
	 */
	protected $availableIncludes = array(
		'inspection',
		'subAssembly',
		'comments',
	);

	/**
	 * @var array
	 */
	protected $defaultIncludes = array(
		'comments',
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
}