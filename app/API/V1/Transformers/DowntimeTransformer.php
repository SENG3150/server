<?php
namespace App\API\V1\Transformers;

use App\API\V1\Entities\Downtime as Entity;
use App\Transformers\Transformer;

class DowntimeTransformer extends Transformer
{
	/**
	 * @var array
	 */
	protected $availableIncludes = array(
		'machine',
	);
	
	/**
	 * @param Entity $entity
	 *
	 * @return array
	 */
	public function transform(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return array(
				'id'            => $entity->getId(),
				'systemName'    => $entity->getSystemName(),
				'downTimeHours' => $entity->getDownTimeHours(),
				'reason'        => $entity->getReason(),
			);
		}
		
		else
		{
			return array();
		}
	}
	
	/**
	 * @param Entity $entity
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeMachine(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return $this->item($entity->getMachine(), new MachineTransformer());
		}
		
		else
		{
			return NULL;
		}
	}
}