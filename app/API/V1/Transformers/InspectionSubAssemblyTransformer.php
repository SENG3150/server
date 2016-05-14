<?php

namespace App\API\V1\Transformers;

use League\Fractal\TransformerAbstract;

use App\API\V1\Entities\InspectionSubAssembly;

class InspectionSubAssemblyTransformer extends TransformerAbstract
{
	/**
	 * @var array
	 */
	protected $availableIncludes = array(
		'inspection',
		'majorAssembly',
		'subAssembly',
		'comments',
		'machineGeneralTest',
		'oilTest',
		'wearTest',
	);

	/**
	 * @var array
	 */
	protected $defaultIncludes = array(
		'comments',
		'machineGeneralTest',
		'oilTest',
		'wearTest',
	);
	
	/**
	 * @param InspectionSubAssembly $subAssembly
	 *
	 * @return array
	 */
	public function transform(InspectionSubAssembly $subAssembly)
	{
		return array(
			'id' => $subAssembly->getId(),
		);
	}

	/**
	 * @param InspectionSubAssembly $subAssembly
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeInspection(InspectionSubAssembly $subAssembly)
	{
		return $this->item($subAssembly->getInspection(), new InspectionTransformer());
	}

	/**
	 * @param InspectionSubAssembly $subAssembly
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeMajorAssembly(InspectionSubAssembly $subAssembly)
	{
		return $this->item($subAssembly->getMajorAssembly(), new InspectionMajorAssemblyTransformer());
	}

	/**
	 * @param InspectionSubAssembly $subAssembly
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeSubAssembly(InspectionSubAssembly $subAssembly)
	{
		return $this->item($subAssembly->getSubAssembly(), new SubAssemblyTransformer());
	}

	/**
	 * @param InspectionSubAssembly $subAssembly
	 *
	 * @return \League\Fractal\Resource\Collection
	 */
	public function includeComments(InspectionSubAssembly $subAssembly)
	{
		return $this->collection($subAssembly->getComments(), new CommentTransformer());
	}
	
	/**
	 * @param InspectionSubAssembly $subAssembly
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeMachineGeneralTest(InspectionSubAssembly $subAssembly)
	{
		if($subAssembly->getMachineGeneralTest() != NULL)
		{
			return $this->item($subAssembly->getMachineGeneralTest(), new MachineGeneralTestTransformer());
		}

		else
		{
			return NULL;
		}
	}
	
	/**
	 * @param InspectionSubAssembly $subAssembly
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeOilTest(InspectionSubAssembly $subAssembly)
	{
		if($subAssembly->getOilTest() != NULL)
		{
			return $this->item($subAssembly->getOilTest(), new OilTestTransformer());
		}

		else
		{
			return NULL;
		}
	}
	
	/**
	 * @param InspectionSubAssembly $subAssembly
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeWearTest(InspectionSubAssembly $subAssembly)
	{
		if($subAssembly->getWearTest() != NULL)
		{
			return $this->item($subAssembly->getWearTest(), new WearTestTransformer());
		}

		else
		{
			return NULL;
		}
	}
}