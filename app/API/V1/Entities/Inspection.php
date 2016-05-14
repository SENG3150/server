<?php

namespace App\API\V1\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="inspections")
 */
class Inspection extends \ArrayObject
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(name="id", type="integer")
	 * @var int $id
	 */
	protected $id;

	/**
	 * @ORM\Column(name="time_created", type="datetime", nullable=true)
	 * @var \DateTime $timeCreated
	 */
	protected $timeCreated;

	/**
	 * @ORM\Column(name="time_scheduled", type="datetime", nullable=true)
	 * @var \DateTime $timeScheduled
	 */
	protected $timeScheduled;

	/**
	 * @ORM\Column(name="time_started", type="datetime", nullable=true)
	 * @var \DateTime $timeStarted
	 */
	protected $timeStarted;

	/**
	 * @ORM\Column(name="time_completed", type="datetime", nullable=true)
	 * @var \DateTime $timeCompleted
	 */
	protected $timeCompleted;

	/**
	 * @ORM\ManyToOne(targetEntity="Machine", inversedBy="inspections", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var Machine $machine
	 */
	protected $machine;

	/**
	 * @ORM\ManyToOne(targetEntity="Technician", inversedBy="inspections", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var Technician $technician
	 */
	protected $technician;

	/**
	 * @ORM\ManyToOne(targetEntity="DomainExpert", inversedBy="inspections", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var DomainExpert $scheduler
	 */
	protected $scheduler;

	/**
	 * @ORM\OneToMany(targetEntity="InspectionMajorAssembly", mappedBy="inspection", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var InspectionMajorAssembly[]|ArrayCollection $majorAssemblies
	 */
	protected $majorAssemblies;

	/**
	 * @ORM\OneToMany(targetEntity="Comment", mappedBy="inspection", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var Comment[]|ArrayCollection $comments
	 */
	protected $comments;
	
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
	 * @return \DateTime
	 */
	public function getTimeCreated()
	{
		return $this->timeCreated;
	}
	
	/**
	 * @param \DateTime $timeCreated
	 *
	 * @return $this
	 */
	public function setTimeCreated($timeCreated)
	{
		$this->timeCreated = $timeCreated;
		
		return $this;
	}
	
	/**
	 * @return \DateTime
	 */
	public function getTimeScheduled()
	{
		return $this->timeScheduled;
	}
	
	/**
	 * @param \DateTime $timeScheduled
	 *
	 * @return $this
	 */
	public function setTimeScheduled($timeScheduled)
	{
		$this->timeScheduled = $timeScheduled;
		
		return $this;
	}
	
	/**
	 * @return \DateTime
	 */
	public function getTimeStarted()
	{
		return $this->timeStarted;
	}
	
	/**
	 * @param \DateTime $timeStarted
	 *
	 * @return $this
	 */
	public function setTimeStarted($timeStarted)
	{
		$this->timeStarted = $timeStarted;
		
		return $this;
	}
	
	/**
	 * @return \DateTime
	 */
	public function getTimeCompleted()
	{
		return $this->timeCompleted;
	}
	
	/**
	 * @param \DateTime $timeCompleted
	 *
	 * @return $this
	 */
	public function setTimeCompleted($timeCompleted)
	{
		$this->timeCompleted = $timeCompleted;
		
		return $this;
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
	 *
	 * @return $this
	 */
	public function setMachine($machine)
	{
		$this->machine = $machine;
		
		return $this;
	}
	
	/**
	 * @return Technician
	 */
	public function getTechnician()
	{
		return $this->technician;
	}
	
	/**
	 * @param Technician $technician
	 *
	 * @return $this
	 */
	public function setTechnician($technician)
	{
		$this->technician = $technician;
		
		return $this;
	}
	
	/**
	 * @return DomainExpert
	 */
	public function getScheduler()
	{
		return $this->scheduler;
	}
	
	/**
	 * @param DomainExpert $scheduler
	 *
	 * @return $this
	 */
	public function setScheduler($scheduler)
	{
		$this->scheduler = $scheduler;
		
		return $this;
	}

	/**
	 * @return InspectionMajorAssembly[]|ArrayCollection
	 */
	public function getMajorAssemblies()
	{
		return $this->majorAssemblies;
	}

	/**
	 * @param InspectionMajorAssembly[]|ArrayCollection $majorAssemblies
	 *
	 * @return $this
	 */
	public function setMajorAssemblies($majorAssemblies)
	{
		$this->majorAssemblies = $majorAssemblies;

		return $this;
	}

	/**
	 * @return Comment[]|ArrayCollection
	 */
	public function getComments()
	{
		return $this->comments;
	}

	/**
	 * @param Comment[]|ArrayCollection $comments
	 *
	 * @return $this
	 */
	public function setComments($comments)
	{
		$this->comments = $comments;

		return $this;
	}
}