<?php

namespace App\API\V1\Entities;

use App\Entities\Entity;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="inspection_major_assemblies")
 */
class InspectionMajorAssembly extends Entity
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(name="id", type="integer")
	 * @var int $id
	 */
	protected $id;

	/**
	 * @ORM\ManyToOne(targetEntity="Inspection", inversedBy="majorAssemblies", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var Inspection $inspection
	 */
	protected $inspection;

	/**
	 * @ORM\ManyToOne(targetEntity="MajorAssembly", inversedBy="inspections", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var MajorAssembly $majorAssembly
	 */
	protected $majorAssembly;

	/**
	 * @ORM\OneToMany(targetEntity="InspectionSubAssembly", mappedBy="majorAssembly", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var InspectionSubAssembly[]|ArrayCollection $subAssemblies
	 */
	protected $subAssemblies;

	/**
	 * @ORM\OneToMany(targetEntity="Comment", mappedBy="majorAssembly", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var Comment[]|ArrayCollection $comments
	 */
	protected $comments;

	/**
	 * @ORM\OneToMany(targetEntity="Photo", mappedBy="majorAssembly", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var Photo[]|ArrayCollection $photos
	 */
	protected $photos;

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
	 * @return MajorAssembly
	 */
	public function getMajorAssembly()
	{
		return $this->majorAssembly;
	}

	/**
	 * @param MajorAssembly $majorAssembly
	 *
	 * @return $this
	 */
	public function setMajorAssembly($majorAssembly)
	{
		$this->majorAssembly = $majorAssembly;

		return $this;
	}

	/**
	 * @return InspectionSubAssembly[]|ArrayCollection
	 */
	public function getSubAssemblies()
	{
		return $this->subAssemblies;
	}

	/**
	 * @param InspectionSubAssembly[]|ArrayCollection $subAssemblies
	 *
	 * @return $this
	 */
	public function setSubAssemblies($subAssemblies)
	{
		$this->subAssemblies = $subAssemblies;

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
}