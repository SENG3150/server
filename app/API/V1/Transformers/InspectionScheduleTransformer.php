<?php

namespace App\API\V1\Transformers;

use App\API\V1\Entities\Inspection;

class InspectionScheduleTransformer extends Transformer
{
	/**
	 * @var array
	 */
	protected $availableIncludes = array(
		'inspection',
	);
	
	/**
	 * @param InspectionSchedule $inspectionSchedule
	 *
	 * @return array
	 */
	public function transform(InspectionSchedule $inspectionSchedule)
	{
		return array(
			'id'                    => $inspectionSchedule->getId(),
			'inspection'            => $inspectionSchedule->getInspection(),
			'nextInspectionTime'    => $inspectionSchedule->getNextInspectionTime(),
			'value'                 => $inspectionSchedule->getValue(),
			'period'                => $inspectionSchedule->getPeriod(),
		);
	}

	/**
	 * @param InspectionSchedule $inspectionSchedule
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeInspection(InspectionSchedule $inspectionSchedule)
	{
		return $this->item($inspectionSchedule->getInspection(), new InspectionTransformer());
	}
}