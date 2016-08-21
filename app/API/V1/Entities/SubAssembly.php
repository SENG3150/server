<?php

namespace App\API\V1\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="sub_assemblies")
 */
class SubAssembly extends \ArrayObject
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(name="id", type="integer")
	 * @var int $id
	 */
	protected $id;
	
	/**
	 * @ORM\Column(name="name", type="text")
	 * @var string $name
	 */
	protected $name;

	/**
	 * @ORM\ManyToOne(targetEntity="MajorAssembly", inversedBy="subAssemblies", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var MajorAssembly $majorAssembly
	 */
	protected $majorAssembly;

	/**
	 * @ORM\OneToMany(targetEntity="SubAssemblyTest", mappedBy="subAssembly", cascade={"persist"})
	 * @var ArrayCollection|SubAssemblyTest[] $tests
	 */
	protected $tests;

	/**
	 * @ORM\OneToMany(targetEntity="InspectionSubAssembly", mappedBy="subAssembly", cascade={"persist"})
	 * @var ArrayCollection|InspectionSubAssembly[] $inspections
	 */
	protected $inspections;
	/**
	 * @ORM\ManyToOne(targetEntity="SubAssembly", inversedBy="tests", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var SubAssembly $subAssembly
	 */
	protected $subAssembly;

	/**
	 * @ORM\Column(name="machine_general", type="boolean")
	 * @var bool $machineGeneral
	 */
	protected $machineGeneral;

	/**
	 * @ORM\Column(name="machine_general_lower", type="decimal", nullable=true, precision=10, scale=5)
	 * @var double $machineGeneralLower
	 */
	protected $machineGeneralLower;

	/**
	 * @ORM\Column(name="machine_general_upper", type="decimal", nullable=true, precision=10, scale=5)
	 * @var double $machineGeneralUpper
	 */
	protected $machineGeneralUpper;

	/**
	 * @ORM\Column(name="oil", type="boolean")
	 * @var bool $oil
	 */
	protected $oil;

	/**
	 * @ORM\Column(name="oil_lower", type="decimal", nullable=true, precision=10, scale=5)
	 * @var double $oilLower
	 */
	protected $oilLower;

	/**
	 * @ORM\Column(name="oil_upper", type="decimal", nullable=true, precision=10, scale=5)
	 * @var double $oilUpper
	 */
	protected $oilUpper;

	/**
	 * @ORM\Column(name="wear", type="boolean")
	 * @var bool $wear
	 */
	protected $wear;

	/**
	 * @ORM\Column(name="wear_lower", type="decimal", nullable=true, precision=10, scale=5)
	 * @var double $wearLower
	 */
	protected $wearLower;

	/**
	 * @ORM\Column(name="wear_upper", type="decimal", nullable=true, precision=10, scale=5)
	 * @var double $wearUpper
	 */
	protected $wearUpper;
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
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 *
	 * @return $this
	 */
	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getMajorAssembly()
	{
		return $this->majorAssembly;
	}

	/**
	 * @param mixed $majorAssembly
	 *
	 * @return $this
	 */
	public function setMajorAssembly($majorAssembly)
	{
		$this->majorAssembly = $majorAssembly;

		return $this;
	}

	/**
	 * @return SubAssemblyTest[]|ArrayCollection
	 */
	public function getTests()
	{
		return $this->tests;
	}

	/**
	 * @param SubAssemblyTest[]|ArrayCollection $tests
	 *
	 * @return $this
	 */
	public function setTests($tests)
	{
		$this->tests = $tests;

		return $this;
	}

	/**
	 * @return InspectionSubAssembly[]|ArrayCollection
	 */
	public function getInspections()
	{
		return $this->inspections;
	}

	/**
	 * @param InspectionSubAssembly[]|ArrayCollection $inspections
	 *
	 * @return $this
	 */
	public function setInspections($inspections)
	{
		$this->inspections = $inspections;

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
	 */
	public function setSubAssembly($subAssembly)
	{
		$this->subAssembly = $subAssembly;
	}

	/**
	 * @return boolean
	 */
	public function isMachineGeneral()
	{
		return $this->machineGeneral;
	}

	/**
	 * @param boolean $machineGeneral
	 */
	public function setMachineGeneral($machineGeneral)
	{
		$this->machineGeneral = $machineGeneral;
	}

	/**
	 * @return float
	 */
	public function getMachineGeneralLower()
	{
		return $this->machineGeneralLower;
	}

	/**
	 * @param float $machineGeneralLower
	 */
	public function setMachineGeneralLower($machineGeneralLower)
	{
		$this->machineGeneralLower = $machineGeneralLower;
	}

	/**
	 * @return float
	 */
	public function getMachineGeneralUpper()
	{
		return $this->machineGeneralUpper;
	}

	/**
	 * @param float $machineGeneralUpper
	 */
	public function setMachineGeneralUpper($machineGeneralUpper)
	{
		$this->machineGeneralUpper = $machineGeneralUpper;
	}

	/**
	 * @return boolean
	 */
	public function isOil()
	{
		return $this->oil;
	}

	/**
	 * @param boolean $oil
	 */
	public function setOil($oil)
	{
		$this->oil = $oil;
	}

	/**
	 * @return float
	 */
	public function getOilLower()
	{
		return $this->oilLower;
	}

	/**
	 * @param float $oilLower
	 */
	public function setOilLower($oilLower)
	{
		$this->oilLower = $oilLower;
	}

	/**
	 * @return float
	 */
	public function getOilUpper()
	{
		return $this->oilUpper;
	}

	/**
	 * @param float $oilUpper
	 */
	public function setOilUpper($oilUpper)
	{
		$this->oilUpper = $oilUpper;
	}

	/**
	 * @return boolean
	 */
	public function isWear()
	{
		return $this->wear;
	}

	/**
	 * @param boolean $wear
	 */
	public function setWear($wear)
	{
		$this->wear = $wear;
	}

	/**
	 * @return float
	 */
	public function getWearLower()
	{
		return $this->wearLower;
	}

	/**
	 * @param float $wearLower
	 */
	public function setWearLower($wearLower)
	{
		$this->wearLower = $wearLower;
	}

	/**
	 * @return float
	 */
	public function getWearUpper()
	{
		return $this->wearUpper;
	}

	/**
	 * @param float $wearUpper
	 */
	public function setWearUpper($wearUpper)
	{
		$this->wearUpper = $wearUpper;
	}
	
}