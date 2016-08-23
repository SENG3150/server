<?php

namespace App\API\V1\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="inspection_schedules")
 */
class InspectionSchedule extends DeletableEntity
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(name="id", type="integer")
	 * @var int $id
	 */
	protected $id;

	/**
	 * @ORM\ManyToOne(targetEntity="Inspection", inversedBy="schedule", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var Inspection $inspection
	 */
	protected $inspection;

	/**
	 * @ORM\OneToMany(targetEntity="Inspection", mappedBy="schedule", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var ArrayCollection|Inspection[] $inspections
	 */
	protected $inspections;

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
	 * @return \App\API\V1\Entities\Inspection[]|\Doctrine\Common\Collections\ArrayCollection
	 */
	public function getInspections()
	{
		return $this->inspections;
	}

	/**
	 * @param \App\API\V1\Entities\Inspection[]|\Doctrine\Common\Collections\ArrayCollection $inspections
	 *
	 * @return $this
	 */
	public function setInspections($inspections)
	{
		$this->inspections = $inspections;

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