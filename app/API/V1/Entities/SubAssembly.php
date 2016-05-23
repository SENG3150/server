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
}