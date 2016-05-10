<?php

namespace App\API\V1\Transformers;

use League\Fractal\TransformerAbstract;

use App\API\V1\Entities\Inspection;

class InspectionTransformer extends TransformerAbstract
{
	/**
	 * @var array
	 */
	protected $availableIncludes = array(
		'machine',
		'technician',
		'scheduler',
		'majorAssemblies',
		'comments',
	);

	/**
	 * @var array
	 */
	protected $defaultIncludes = array(
		'majorAssemblies',
		'comments',
	);
	
	/**
	 * @param Inspection $inspection
	 *
	 * @return array
	 */
	public function transform(Inspection $inspection)
	{
		return array(
			'id'            => $inspection->getId(),
			'timeCreated'   => $inspection->getTimeCreated(),
			'timeScheduled' => $inspection->getTimeScheduled(),
			'timeStarted'   => $inspection->getTimeStarted(),
			'timeCompleted' => $inspection->getTimeCompleted(),
		);
	}

	/**
	 * @param Inspection $inspection
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeMachine(Inspection $inspection)
	{
		return $this->item($inspection->getMachine(), new MachineTransformer());
	}

	/**
	 * @param Inspection $inspection
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeTechnician(Inspection $inspection)
	{
		return $this->item($inspection->getTechnician(), new TechnicianTransformer());
	}

	/**
	 * @param Inspection $inspection
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeScheduler(Inspection $inspection)
	{
		return $this->item($inspection->getScheduler(), new DomainExpertTransformer());
	}

	/**
	 * @param Inspection $inspection
	 *
	 * @return \League\Fractal\Resource\Collection
	 */
	public function includeMajorAssemblies(Inspection $inspection)
	{
		return $this->collection($inspection->getMajorAssemblies(), new InspectionMajorAssemblyTransformer());
	}

	/**
	 * @param Inspection $inspection
	 *
	 * @return \League\Fractal\Resource\Collection
	 */
	public function includeComments(Inspection $inspection)
	{
		return $this->collection($inspection->getComments(), new InspectionCommentTransformer());
	}
}