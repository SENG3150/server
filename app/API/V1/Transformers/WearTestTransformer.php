<?php

namespace App\API\V1\Transformers;

use League\Fractal\TransformerAbstract;

use App\API\V1\Entities\WearTest;

class WearTestTransformer extends TransformerAbstract
{
	/**
	 * @var array
	 */
	protected $availableIncludes = array(
		'inspection',
		'subAssembly',
		'comments',
		'actionItem',
	);

	/**
	 * @var array
	 */
	protected $defaultIncludes = array(
		'comments',
		'actionItem',
	);
	
	/**
	 * @param WearTest $wearTest
	 *
	 * @return array
	 */
	public function transform(WearTest $wearTest)
	{
		return array(
			'id'            => $wearTest->getId(),
			'description'   => $wearTest->getDescription(),
			'new'           => $wearTest->getNew(),
			'limit'         => $wearTest->getLimit(),
			'lifeLower'     => $wearTest->getLifeLower(),
			'lifeUpper'     => $wearTest->getLifeUpper(),
			'timeStart'     => $wearTest->getTimeStart(),
			'uniqueDetails' => $wearTest->getUniqueDetails(),
		);
	}

	/**
	 * @param WearTest $wearTest
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeInspection(WearTest $wearTest)
	{
		return $this->item($wearTest->getInspection(), new InspectionTransformer());
	}

	/**
	 * @param WearTest $wearTest
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeSubAssembly(WearTest $wearTest)
	{
		return $this->item($wearTest->getSubAssembly(), new InspectionSubAssemblyTransformer());
	}

	/**
	 * @param WearTest $wearTest
	 *
	 * @return \League\Fractal\Resource\Collection
	 */
	public function includeComments(WearTest $wearTest)
	{
		return $this->collection($wearTest->getComments(), new CommentTransformer());
	}

	/**
	 * @param WearTest $wearTest
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeActionItem(WearTest $wearTest)
	{
		return $this->item($wearTest->getActionItem(), new ActionItemTransformer());
	}
}