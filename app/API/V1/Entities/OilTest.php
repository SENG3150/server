<?php

namespace App\API\V1\Entities;

use App\Entities\Entity;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="tests_oil")
 */
class OilTest extends Entity
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(name="id", type="integer")
	 * @var int $id
	 */
	protected $id;

	/**
	 * @ORM\ManyToOne(targetEntity="Inspection", inversedBy="oilTests", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var Inspection $inspection
	 */
	protected $inspection;

	/**
	 * @ORM\OneToOne(targetEntity="InspectionSubAssembly", inversedBy="oilTest", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var InspectionSubAssembly $subAssembly
	 */
	protected $subAssembly;

	/**
	 * @ORM\OneToOne(targetEntity="ActionItem", mappedBy="oilTest", cascade={"persist"},
	 *                                                      fetch="EXTRA_LAZY")
	 * @var ActionItem $actionItem
	 */
	protected $actionItem;

	/**
	 * @ORM\OneToMany(targetEntity="Comment", mappedBy="oilTest", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var Comment[]|ArrayCollection $comments
	 */
	protected $comments;

	/**
	 * @ORM\OneToMany(targetEntity="Photo", mappedBy="oilTest", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var Photo[]|ArrayCollection $photos
	 */
	protected $photos;

	/**
	 * @ORM\Column(name="lead", type="integer")
	 * @var int $lead
	 */
	protected $lead;

	/**
	 * @ORM\Column(name="copper", type="integer")
	 * @var int $copper
	 */
	protected $copper;

	/**
	 * @ORM\Column(name="tin", type="integer")
	 * @var int $tin
	 */
	protected $tin;

	/**
	 * @ORM\Column(name="iron", type="integer")
	 * @var int $iron
	 */
	protected $iron;

	/**
	 * @ORM\Column(name="pq90", type="integer")
	 * @var int $pq90
	 */
	protected $pq90;

	/**
	 * @ORM\Column(name="silicon", type="integer")
	 * @var int $silicon
	 */
	protected $silicon;

	/**
	 * @ORM\Column(name="sodium", type="integer")
	 * @var int $sodium
	 */
	protected $sodium;

	/**
	 * @ORM\Column(name="aluminium", type="integer")
	 * @var int $aluminium
	 */
	protected $aluminium;

	/**
	 * @ORM\Column(name="water", type="decimal", nullable=true, precision=10, scale=5)
	 * @var double $water
	 */
	protected $water;

	/**
	 * @ORM\Column(name="viscosity", type="integer")
	 * @var int $viscosity
	 */
	protected $viscosity;

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
	 * @return \App\API\V1\Entities\ActionItem
	 */
	public function getActionItem()
	{
		return $this->actionItem;
	}

	/**
	 * @param \App\API\V1\Entities\ActionItem $actionItem
	 *
	 * @return $this
	 */
	public function setActionItem($actionItem)
	{
		$this->actionItem = $actionItem;

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
	 * @return Photo[]|ArrayCollection
	 */
	public function getPhotos()
	{
		return $this->photos;
	}

	/**
	 * @param Photo[]|ArrayCollection $photos
	 *
	 * @return $this
	 */
	public function setPhotos($photos)
	{
		$this->photos = $photos;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getLead()
	{
		return $this->lead;
	}

	/**
	 * @param int $lead
	 *
	 * @return $this
	 */
	public function setLead($lead)
	{
		$this->lead = $lead;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getCopper()
	{
		return $this->copper;
	}

	/**
	 * @param int $copper
	 *
	 * @return $this
	 */
	public function setCopper($copper)
	{
		$this->copper = $copper;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getTin()
	{
		return $this->tin;
	}

	/**
	 * @param int $tin
	 *
	 * @return $this
	 */
	public function setTin($tin)
	{
		$this->tin = $tin;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getIron()
	{
		return $this->iron;
	}

	/**
	 * @param int $iron
	 *
	 * @return $this
	 */
	public function setIron($iron)
	{
		$this->iron = $iron;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getPq90()
	{
		return $this->pq90;
	}

	/**
	 * @param int $pq90
	 *
	 * @return $this
	 */
	public function setPq90($pq90)
	{
		$this->pq90 = $pq90;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getSilicon()
	{
		return $this->silicon;
	}

	/**
	 * @param int $silicon
	 *
	 * @return $this
	 */
	public function setSilicon($silicon)
	{
		$this->silicon = $silicon;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getSodium()
	{
		return $this->sodium;
	}

	/**
	 * @param int $sodium
	 *
	 * @return $this
	 */
	public function setSodium($sodium)
	{
		$this->sodium = $sodium;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getAluminium()
	{
		return $this->aluminium;
	}

	/**
	 * @param int $aluminium
	 *
	 * @return $this
	 */
	public function setAluminium($aluminium)
	{
		$this->aluminium = $aluminium;

		return $this;
	}

	/**
	 * @return double
	 */
	public function getWater()
	{
		return $this->water;
	}

	/**
	 * @param double $water
	 *
	 * @return $this
	 */
	public function setWater($water)
	{
		$this->water = $water;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getViscosity()
	{
		return $this->viscosity;
	}

	/**
	 * @param int $viscosity
	 *
	 * @return $this
	 */
	public function setViscosity($viscosity)
	{
		$this->viscosity = $viscosity;

		return $this;
	}
}