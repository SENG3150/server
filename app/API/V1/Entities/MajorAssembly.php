<?php

namespace App\API\V1\Entities;

use App\Entities\Entity;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="major_assemblies")
 */
class MajorAssembly extends Entity
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
	 * @ORM\ManyToOne(targetEntity="Model", inversedBy="majorAssemblies", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var Model $model
	 */
	protected $model;

	/**
	 * @ORM\OneToMany(targetEntity="SubAssembly", mappedBy="majorAssembly", cascade={"persist"})
	 * @var ArrayCollection|SubAssembly[] $subAssemblies
	 */
	protected $subAssemblies;

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
	 * @return Model
	 */
	public function getModel()
	{
		return $this->model;
	}

	/**
	 * @param Model $model
	 *
	 * @return $this
	 */
	public function setModel($model)
	{
		$this->model = $model;

		return $this;
	}

	/**
	 * @return SubAssembly[]|ArrayCollection
	 */
	public function getSubAssemblies()
	{
		return $this->subAssemblies;
	}

	/**
	 * @param SubAssembly[]|ArrayCollection $subAssemblies
	 *
	 * @return $this
	 */
	public function setSubAssemblies($subAssemblies)
	{
		$this->subAssemblies = $subAssemblies;

		return $this;
	}
}