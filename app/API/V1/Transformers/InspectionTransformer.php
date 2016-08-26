<?php

namespace App\API\V1\Transformers;

use App\API\V1\Entities\Inspection;
use App\Transformers\Transformer;

class InspectionTransformer extends Transformer
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
		'photos',
	);

	/**
	 * @var array
	 */
	protected $defaultIncludes = array(
		'majorAssemblies',
		'comments',
		'photos',
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
		if($inspection->getScheduler() != NULL)
		{
			return $this->item($inspection->getScheduler(), new DomainExpertTransformer());
		}

		else
		{
			return NULL;
		}
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
		return $this->collection($inspection->getComments(), new CommentTransformer());
	}

	/**
	 * @param Inspection $inspection
	 *
	 * @return \League\Fractal\Resource\Collection
	 */
	public function includePhotos(Inspection $inspection)
	{
		return $this->collection($inspection->getPhotos(), new PhotoTransformer());
	}
}