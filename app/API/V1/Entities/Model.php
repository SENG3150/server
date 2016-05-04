<?php

namespace App\API\V1\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="models")
 */
class Model extends \ArrayObject
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
	 * @ORM\OneToMany(targetEntity="MajorAssembly", mappedBy="model", cascade={"persist"})
	 * @var ArrayCollection|MajorAssembly[] $majorAssemblies
	 */
	protected $majorAssemblies;

	/**
	 * @ORM\OneToMany(targetEntity="Machine", mappedBy="model", cascade={"persist"})
	 * @var ArrayCollection|Machine[] $machines
	 */
	protected $machines;
	
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
	 * @return MajorAssembly[]|ArrayCollection
	 */
	public function getMajorAssemblies()
	{
		return $this->majorAssemblies;
	}
	
	/**
	 * @param MajorAssembly[]|ArrayCollection $majorAssemblies
	 *
	 * @return $this
	 */
	public function setMajorAssemblies($majorAssemblies)
	{
		$this->majorAssemblies = $majorAssemblies;
		
		return $this;
	}

	/**
	 * @return Machine[]|ArrayCollection
	 */
	public function getMachines()
	{
		return $this->machines;
	}

	/**
	 * @param Machine[]|ArrayCollection $machines
	 *
	 * @return $this
	 */
	public function setMachines($machines)
	{
		$this->machines = $machines;

		return $this;
	}
}