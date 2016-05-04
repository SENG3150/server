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
	 * @ORM\Column(name="machineGeneral", type="boolean")
	 * @var bool $machineGeneral
	 */
	protected $machineGeneral;

	/**
	 * @ORM\Column(name="oil", type="boolean")
	 * @var bool $oil
	 */
	protected $oil;

	/**
	 * @ORM\Column(name="wear", type="boolean")
	 * @var bool $wear
	 */
	protected $wear;

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
}