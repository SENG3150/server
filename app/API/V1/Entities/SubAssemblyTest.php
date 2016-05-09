<?php

namespace App\API\V1\Entities;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="sub_assembly_tests")
 */
class SubAssemblyTest extends \ArrayObject
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(name="id", type="integer")
	 * @var int $id
	 */
	protected $id;

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
	 * @return boolean
	 */
	public function hasMachineGeneral()
	{
		return $this->machineGeneral;
	}

	/**
	 * @param boolean $machineGeneral
	 *
	 * @return $this
	 */
	public function setMachineGeneral($machineGeneral)
	{
		$this->machineGeneral = $machineGeneral;

		return $this;
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
	 *
	 * @return $this
	 */
	public function setMachineGeneralLower($machineGeneralLower)
	{
		$this->machineGeneralLower = $machineGeneralLower;

		return $this;
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
	 *
	 * @return $this
	 */
	public function setMachineGeneralUpper($machineGeneralUpper)
	{
		$this->machineGeneralUpper = $machineGeneralUpper;

		return $this;
	}

	/**
	 * @return boolean
	 */
	public function hasOil()
	{
		return $this->oil;
	}

	/**
	 * @param boolean $oil
	 *
	 * @return $this
	 */
	public function setOil($oil)
	{
		$this->oil = $oil;

		return $this;
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
	 *
	 * @return $this
	 */
	public function setOilLower($oilLower)
	{
		$this->oilLower = $oilLower;

		return $this;
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
	 *
	 * @return $this
	 */
	public function setOilUpper($oilUpper)
	{
		$this->oilUpper = $oilUpper;

		return $this;
	}

	/**
	 * @return boolean
	 */
	public function hasWear()
	{
		return $this->wear;
	}

	/**
	 * @param boolean $wear
	 *
	 * @return $this
	 */
	public function setWear($wear)
	{
		$this->wear = $wear;

		return $this;
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
	 *
	 * @return $this
	 */
	public function setWearLower($wearLower)
	{
		$this->wearLower = $wearLower;

		return $this;
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
	 *
	 * @return $this
	 */
	public function setWearUpper($wearUpper)
	{
		$this->wearUpper = $wearUpper;

		return $this;
	}
}