<?php

namespace App\API\V1\Transformers;

use League\Fractal\TransformerAbstract;

use App\API\V1\Entities\SubAssembly;

class SubAssemblyTransformer extends TransformerAbstract
{
	/**
	 * @var array
	 */
	protected $availableIncludes = array(
		'majorAssembly',
		'tests',
		'inspections',
	);

	/**
	 * @param SubAssembly $subAssembly
	 *
	 * @return array
	 */
	public function transform(SubAssembly $subAssembly)
	{
		return array(
			'id'   => $subAssembly->getId(),
			'name' => $subAssembly->getName(),
		);
	}

	/**
	 * @param SubAssembly $subAssembly
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeMajorAssembly(SubAssembly $subAssembly)
	{
		return $this->item($subAssembly->getMajorAssembly(), new MajorAssemblyTransformer());
	}

	/**
	 * @param SubAssembly $subAssembly
	 *
	 * @return \League\Fractal\Resource\Collection
	 */
	public function includeTests(SubAssembly $subAssembly)
	{
		return $this->collection($subAssembly->getTests(), new SubAssemblyTestTransformer());
	}

	/**
	 * @param SubAssembly $subAssembly
	 *
	 * @return \League\Fractal\Resource\Collection
	 */
	public function includeInspections(SubAssembly $subAssembly)
	{
		return $this->collection($subAssembly->getInspections(), new InspectionSubAssemblyTransformer());
	}
}