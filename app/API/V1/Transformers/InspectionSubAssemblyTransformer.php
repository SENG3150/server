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
	);

	/**
	 * @var array
	 */
	protected $defaultIncludes = array(
		'comments',
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
		return $this->collection($subAssembly->getComments(), new InspectionCommentTransformer());
	}
}