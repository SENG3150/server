<?php

namespace App\API\V1\Entities;

use App\Entities\Entity;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="sub_assemblies")
 */
class SubAssembly extends Entity
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
     * @ORM\OneToMany(targetEntity="InspectionSubAssembly", mappedBy="subAssembly", cascade={"persist"})
     * @var ArrayCollection|InspectionSubAssembly[] $inspections
     */
    protected $inspections;


    /**
     * @ORM\Column(name="machine_general", type="boolean")
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
	 * @ORM\Column(name="unique_details", type="array")
	 * @var array $uniqueDetails
	 */
	protected $uniqueDetails = array();

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
     * @return boolean
     */
    public function hasMachineGeneral()
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
     * @return boolean
     */
    public function hasOil()
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
     * @return boolean
     */
    public function hasWear()
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