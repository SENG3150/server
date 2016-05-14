<?php

namespace App\API\V1\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="inspection_sub_assemblies")
 */
class InspectionSubAssembly extends \ArrayObject
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
	 * @ORM\ManyToOne(targetEntity="InspectionMajorAssembly", inversedBy="subAssemblies", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var InspectionMajorAssembly $majorAssembly
	 */
	protected $majorAssembly;

	/**
	 * @ORM\ManyToOne(targetEntity="SubAssembly", inversedBy="inspections", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var SubAssembly $subAssembly
	 */
	protected $subAssembly;

	/**
	 * @ORM\OneToMany(targetEntity="Comment", mappedBy="subAssembly", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var Comment[]|ArrayCollection $comments
	 */
	protected $comments;

	/**
	 * @ORM\OneToOne(targetEntity="MachineGeneralTest", mappedBy="subAssembly", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var MachineGeneralTest $machineGeneralTest
	 */
	protected $machineGeneralTest;

	/**
	 * @ORM\OneToOne(targetEntity="OilTest", mappedBy="subAssembly", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var OilTest $oilTest
	 */
	protected $oilTest;

	/**
	 * @ORM\OneToOne(targetEntity="WearTest", mappedBy="subAssembly", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var WearTest $wearTest
	 */
	protected $wearTest;

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
	 * @return InspectionMajorAssembly
	 */
	public function getMajorAssembly()
	{
		return $this->majorAssembly;
	}

	/**
	 * @param InspectionMajorAssembly $majorAssembly
	 *
	 * @return $this
	 */
	public function setMajorAssembly($majorAssembly)
	{
		$this->majorAssembly = $majorAssembly;

		return $this;
	}

	/**
	 * @return SubAssembly
	 */
	public function getSubAssembly()
	{
		return $this->subAssembly;
	}

	/**
	 * @param SubAssembly $subAssembly
	 *
	 * @return $this
	 */
	public function setSubAssembly($subAssembly)
	{
		$this->subAssembly = $subAssembly;

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
}