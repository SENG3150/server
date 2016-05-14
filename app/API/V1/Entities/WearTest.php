<?php

namespace App\API\V1\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="tests_wear")
 */
class WearTest extends \ArrayObject
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(name="id", type="integer")
	 * @var int $id
	 */
	protected $id;

	/**
	 * @ORM\ManyToOne(targetEntity="Inspection", inversedBy="wearTests", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var Inspection $inspection
	 */
	protected $inspection;

	/**
	 * @ORM\OneToOne(targetEntity="InspectionSubAssembly", inversedBy="wearTest", cascade={"persist"},
	 *                                                     fetch="EXTRA_LAZY")
	 * @var InspectionSubAssembly $subAssembly
	 */
	protected $subAssembly;

	/**
	 * @ORM\OneToMany(targetEntity="Comment", mappedBy="wearTest", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var Comment[]|ArrayCollection $comments
	 */
	protected $comments;

	/**
	 * @ORM\Column(name="description", type="text")
	 * @var string $description
	 */
	protected $description;

	/**
	 * @ORM\Column(name="new", type="text")
	 * @var string $new
	 */
	protected $new;

	/**
	 * @ORM\Column(name="limit", type="text")
	 * @var string $limit
	 */
	protected $limit;

	/**
	 * @ORM\Column(name="life_lower", type="text")
	 * @var string $lifeLower
	 */
	protected $lifeLower;

	/**
	 * @ORM\Column(name="life_upper", type="text")
	 * @var string $lifeUpper
	 */
	protected $lifeUpper;

	/**
	 * @ORM\Column(name="time_started", type="datetime")
	 * @var \DateTime $timeStart
	 */
	protected $timeStart;

	/**
	 * @ORM\Column(name="unique_details", type="array")
	 * @var array $uniqueDetails
	 */
	protected $uniqueDetails;

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
	 * @return \App\API\V1\Entities\Inspection
	 */
	public function getInspection()
	{
		return $this->inspection;
	}

	/**
	 * @param \App\API\V1\Entities\Inspection $inspection
	 *
	 * @return $this
	 */
	public function setInspection($inspection)
	{
		$this->inspection = $inspection;

		return $this;
	}

	/**
	 * @return \App\API\V1\Entities\InspectionSubAssembly
	 */
	public function getSubAssembly()
	{
		return $this->subAssembly;
	}

	/**
	 * @param \App\API\V1\Entities\InspectionSubAssembly $subAssembly
	 *
	 * @return $this
	 */
	public function setSubAssembly($subAssembly)
	{
		$this->subAssembly = $subAssembly;

		return $this;
	}

	/**
	 * @return \App\API\V1\Entities\Comment[]|\Doctrine\Common\Collections\ArrayCollection
	 */
	public function getComments()
	{
		return $this->comments;
	}

	/**
	 * @param \App\API\V1\Entities\Comment[]|\Doctrine\Common\Collections\ArrayCollection $comments
	 *
	 * @return $this
	 */
	public function setComments($comments)
	{
		$this->comments = $comments;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * @param string $description
	 *
	 * @return $this
	 */
	public function setDescription($description)
	{
		$this->description = $description;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getNew()
	{
		return $this->new;
	}

	/**
	 * @param string $new
	 *
	 * @return $this
	 */
	public function setNew($new)
	{
		$this->new = $new;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getLimit()
	{
		return $this->limit;
	}

	/**
	 * @param string $limit
	 *
	 * @return $this
	 */
	public function setLimit($limit)
	{
		$this->limit = $limit;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getLifeLower()
	{
		return $this->lifeLower;
	}

	/**
	 * @param string $lifeLower
	 *
	 * @return $this
	 */
	public function setLifeLower($lifeLower)
	{
		$this->lifeLower = $lifeLower;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getLifeUpper()
	{
		return $this->lifeUpper;
	}

	/**
	 * @param string $lifeUpper
	 *
	 * @return $this
	 */
	public function setLifeUpper($lifeUpper)
	{
		$this->lifeUpper = $lifeUpper;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getTimeStart()
	{
		return $this->timeStart;
	}

	/**
	 * @param \DateTime $timeStart
	 *
	 * @return $this
	 */
	public function setTimeStart($timeStart)
	{
		$this->timeStart = $timeStart;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getUniqueDetails()
	{
		return $this->uniqueDetails;
	}

	/**
	 * @param array $uniqueDetails
	 *
	 * @return $this
	 */
	public function setUniqueDetails($uniqueDetails)
	{
		$this->uniqueDetails = $uniqueDetails;

		return $this;
	}
}