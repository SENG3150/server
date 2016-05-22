<?php

namespace App\API\V1\Transformers;

use League\Fractal\TransformerAbstract;

use App\API\V1\Entities\InspectionMajorAssembly;

class InspectionMajorAssemblyTransformer extends TransformerAbstract
{
	/**
	 * @var array
	 */
	protected $availableIncludes = array(
		'inspection',
		'majorAssembly',
		'subAssemblies',
		'comments',
		'photos',
	);

	/**
	 * @var array
	 */
	protected $defaultIncludes = array(
		'subAssemblies',
		'comments',
		'photos',
	);
	
	/**
	 * @param InspectionMajorAssembly $majorAssembly
	 *
	 * @return array
	 */
	public function transform(InspectionMajorAssembly $majorAssembly)
	{
		return array(
			'id' => $majorAssembly->getId(),
		);
	}

	/**
	 * @param InspectionMajorAssembly $majorAssembly
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeInspection(InspectionMajorAssembly $majorAssembly)
	{
		return $this->item($majorAssembly->getInspection(), new InspectionTransformer());
	}

	/**
	 * @param InspectionMajorAssembly $majorAssembly
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeMajorAssembly(InspectionMajorAssembly $majorAssembly)
	{
		return $this->item($majorAssembly->getMajorAssembly(), new MajorAssemblyTransformer());
	}

	/**
	 * @param InspectionMajorAssembly $majorAssembly
	 *
	 * @return \League\Fractal\Resource\Collection
	 */
	public function includeSubAssemblies(InspectionMajorAssembly $majorAssembly)
	{
		return $this->collection($majorAssembly->getSubAssemblies(), new InspectionSubAssemblyTransformer());
	}

	/**
	 * @param InspectionMajorAssembly $majorAssembly
	 *
	 * @return \League\Fractal\Resource\Collection
	 */
	public function includeComments(InspectionMajorAssembly $majorAssembly)
	{
		return $this->collection($majorAssembly->getComments(), new CommentTransformer());
	}

	/**
	 * @param InspectionMajorAssembly $majorAssembly
	 *
	 * @return \League\Fractal\Resource\Collection
	 */
	public function includePhotos(InspectionMajorAssembly $majorAssembly)
	{
		return $this->collection($majorAssembly->getPhotos(), new PhotoTransformer());
	}
}