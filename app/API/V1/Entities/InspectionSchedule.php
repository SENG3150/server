<?php

namespace App\API\V1\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="inspectionSchedule")
 */
class InspectionSchedule extends \ArrayObject
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(name="id", type="integer")
	 * @var int $id
	 */
	protected $id;

	/**
	* @ORM\OneToOne(targetEntity="Inspection", cascade={"persist"}, fetch="EXTRA_LAZY")
	* @var Inspection $inspection
	*/
	protected $inspection;

	/**
	 * @ORM\Column(name="next_inspection_time", type="datetime", nullable=true)
	 * @var \DateTime $nextInspectionTime
	 */
	protected $nextInspectionTime;

	/**
	 * @ORM\Column(name="value", type="integer")
	 * @var int $value
	 */
	protected $value;

	/**
	 * @ORM\Column(name="period", type="string")
	 * @var \String $period
	 */
	protected $period;

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
	 * @return Inspection
	 */
	public function getInspection()
	{
		return $this->inspection;
	}

	/**
	 * @param Inspection $inspection
	 *
	 * @return $this
	 */
	public function setInspection($inspection)
	{
		$this->inspection = $inspection;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getNextInspectionTime()
	{
		return $this->nextInspectionTime;
	}
	
	/**
	 * @param \DateTime $nextInspectionTime
	 *
	 * @return $this
	 */
	public function setNextInspectionTime($nextInspectionTime)
	{
		$this->nextInspectionTime = $nextInspectionTime;
		
		return $this;
	}

	/**
	 * @return int
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * @param int $value
	 *
	 * @return $this
	 */
	public function setValue($value)
	{
		$this->id = $value;

		return $this;
	}

	/**
	 * @return \String
	 */
	public function getPeriod()
	{
		return $this->period;
	}

	/**
	 * @param \String $period
	 *
	 * @return $this
	 */
	public function setPeriod($period)
	{
		$this->period = $period;

		return $this;
	}
}