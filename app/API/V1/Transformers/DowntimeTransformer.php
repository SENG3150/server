<?php
namespace App\API\V1\Transformers;

use App\API\V1\Entities\Downtime;

class DowntimeTransformer extends Transformer{
    /**
     * @var array
     */
    protected $defaultIncludes = array(
        'machine',
    );
    /**
     * @param Downtime $downtime
     *
     * @return array
     */
    public function transform(Downtime $downtime)
    {
        return array(
            'id'            => $downtime->getId(),
            'downTimeHours' => $downtime->getDownTimeHours(),
            'reason'    => $downtime->getReason(),
        );

    }
    /**
     * @param Downtime $downtime
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeMachine(Downtime $downtime)
    {
        return $this->item($downtime->getMachine(), new MachineTransformer());
    }
}