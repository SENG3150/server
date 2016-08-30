<?php

namespace App\API\V1\Entities;

use App\Entities\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="action_items")
 */
class ActionItem extends Entity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     * @var int $id
     */
    protected $id;

    /**
     * @ORM\Column(name="status", type="text")
     * @var string $status
     */
    protected $status;

    /**
     * @ORM\Column(name="issue", type="text", nullable=true)
     * @var string $issue
     */
    protected $issue;

    /**
     * @ORM\Column(name="action", type="text", nullable=true)
     * @var string $action
     */
    protected $action;

    /**
     * @ORM\Column(name="time_actioned", type="datetime")
     * @var \DateTime $timeActioned
     */
    protected $timeActioned;

    /**
     * @ORM\OneToOne(targetEntity="MachineGeneralTest", inversedBy="actionItem", cascade={"persist"},
     *                                                      fetch="EXTRA_LAZY")
     * @var MachineGeneralTest $machineGeneralTest
     */
    protected $machineGeneralTest;

    /**
     * @ORM\OneToOne(targetEntity="OilTest", inversedBy="actionItem", cascade={"persist"},
     *                                                      fetch="EXTRA_LAZY")
     * @var OilTest $oilTest
     */
    protected $oilTest;

    /**
     * @ORM\OneToOne(targetEntity="WearTest", inversedBy="actionItem", cascade={"persist"},
     *                                                      fetch="EXTRA_LAZY")
     * @var WearTest $wearTest
     */
    protected $wearTest;

    /**
     * @ORM\ManyToOne(targetEntity="Technician", inversedBy="OneToOnes", cascade={"persist"}, fetch="EXTRA_LAZY")
     * @var Technician $technician
     */
    protected $technician;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string
     */
    public function getIssue()
    {
        return $this->issue;
    }

    /**
     * @param string $issue
     *
     * @return $this
     */
    public function setIssue($issue)
    {
        $this->issue = $issue;

        return $this;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param string $action
     *
     * @return $this
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTimeActioned()
    {
        return $this->timeActioned;
    }

    /**
     * @param \DateTime $timeActioned
     *
     * @return $this
     */
    public function setTimeActioned($timeActioned)
    {
        $this->timeActioned = $timeActioned;

        return $this;
    }

    /**
     * @return \App\API\V1\Entities\MachineGeneralTest
     */
    public function getMachineGeneralTest()
    {
        return $this->machineGeneralTest;
    }

    /**
     * @param \App\API\V1\Entities\MachineGeneralTest $machineGeneralTest
     *
     * @return $this
     */
    public function setMachineGeneralTest($machineGeneralTest)
    {
        $this->machineGeneralTest = $machineGeneralTest;

        return $this;
    }

    /**
     * @return \App\API\V1\Entities\OilTest
     */
    public function getOilTest()
    {
        return $this->oilTest;
    }

    /**
     * @param \App\API\V1\Entities\OilTest $oilTest
     *
     * @return $this
     */
    public function setOilTest($oilTest)
    {
        $this->oilTest = $oilTest;

        return $this;
    }

    /**
     * @return \App\API\V1\Entities\WearTest
     */
    public function getWearTest()
    {
        return $this->wearTest;
    }

    /**
     * @param \App\API\V1\Entities\WearTest $wearTest
     *
     * @return $this
     */
    public function setWearTest($wearTest)
    {
        $this->wearTest = $wearTest;

        return $this;
    }

    /**
     * @return \App\API\V1\Entities\Technician
     */
    public function getTechnician()
    {
        return $this->technician;
    }

    /**
     * @param \App\API\V1\Entities\Technician $technician
     *
     * @return $this
     */
    public function setTechnician($technician)
    {
        $this->technician = $technician;

        return $this;
    }
}