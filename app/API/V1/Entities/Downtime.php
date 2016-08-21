<?php

namespace App\API\V1\Entities;

use Doctrine\ORM\Mapping AS ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="downtime_data")
 */
class Downtime extends \ArrayObject{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     * @var int $id
     */
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="Machine", inversedBy="Machine", cascade={"persist"},
     *                                                      fetch="EXTRA_LAZY")
     * @var Machine $machine
     */
    protected $machine;

    /**
     * @ORM\Column(name="systemName", type="text")
     * @var string $systemName
     */

    protected $systemName;

    /**
     * @ORM\Column(name="downTimeHours", type="decimal")
     * @var double $downTimeHours
     */
    protected $downTimeHours;

    /**
     * @ORM\Column(name="reason", type="text")
     * @var string $reason
     */
    protected $reason;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Machine
     */
    public function getMachine()
    {
        return $this->machine;
    }

    /**
     * @param Machine $machine
     */
    public function setMachine($machine)
    {
        $this->machine = $machine;
    }

    
    /**
     * @return string
     */
    public function getSystemName()
    {
        return $this->systemName;
    }

    /**
     * @param string $systemName
     */
    public function setSystemName($systemName)
    {
        $this->systemName = $systemName;
    }

    /**
     * @return int
     */
    public function getDownTimeHours()
    {
        return $this->downTimeHours;
    }

    /**
     * @param int $downTimeHours
     */
    public function setDownTimeHours($downTimeHours)
    {
        $this->downTimeHours = $downTimeHours;
    }

    /**
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @param string $reason
     */
    public function setReason($reason)
    {
        $this->reason = $reason;
    }
    
}

