<?php

namespace App\API\V1\Entities;

use App\Entities\Entity;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="tests_wear")
 */
class WearTest extends Entity
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
	 * @ORM\OneToOne(targetEntity="ActionItem", mappedBy="wearTest", cascade={"persist"},
	 *                                                      fetch="EXTRA_LAZY")
	 * @var ActionItem $actionItem
	 */
	protected $actionItem;

	/**
	 * @ORM\OneToMany(targetEntity="Comment", mappedBy="wearTest", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var Comment[]|ArrayCollection $comments
	 */
	protected $comments;

	/**
	 * @ORM\OneToMany(targetEntity="Photo", mappedBy="wearTest", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var Photo[]|ArrayCollection $photos
	 */
	protected $photos;

	/**
	 * @ORM\Column(name="smu", type="integer")
	 * @var int $smu
	 */
	protected $smu;

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
	public function getSmu()
	{
		return $this->smu;
	}

	/**
	 * @param int $smu
	 *
	 * @return $this
	 */
	public function setSmu($smu)
	{
		$this->smu = $smu;

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