<?php

namespace App\API\V1\Transformers;

use League\Fractal\TransformerAbstract;

use App\API\V1\Entities\OilTest;

class OilTestTransformer extends TransformerAbstract
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
	 * @param OilTest $oilTest
	 *
	 * @return array
	 */
	public function transform(OilTest $oilTest)
	{
		return array(
			'id'        => $oilTest->getId(),
			'lead'      => $oilTest->getLead(),
			'copper'    => $oilTest->getCopper(),
			'tin'       => $oilTest->getTin(),
			'iron'      => $oilTest->getIron(),
			'pq90'      => $oilTest->getPq90(),
			'silicon'   => $oilTest->getSilicon(),
			'sodium'    => $oilTest->getSodium(),
			'aluminium' => $oilTest->getAluminium(),
			'water'     => $oilTest->getWater(),
			'viscosity' => $oilTest->getViscosity(),
		);
	}

	/**
	 * @param OilTest $oilTest
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeInspection(OilTest $oilTest)
	{
		return $this->item($oilTest->getInspection(), new InspectionTransformer());
	}

	/**
	 * @param OilTest $oilTest
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeSubAssembly(OilTest $oilTest)
	{
		return $this->item($oilTest->getSubAssembly(), new InspectionSubAssemblyTransformer());
	}

	/**
	 * @param OilTest $oilTest
	 *
	 * @return \League\Fractal\Resource\Collection
	 */
	public function includeComments(OilTest $oilTest)
	{
		return $this->collection($oilTest->getComments(), new CommentTransformer());
	}
	
	/**
	 * @param OilTest $oilTest
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeActionItem(OilTest $oilTest)
	{
		return $this->item($oilTest->getActionItem(), new ActionItemTransformer());
	}
}