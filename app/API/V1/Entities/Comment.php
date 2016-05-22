<?php

namespace App\API\V1\Entities;

use Doctrine\ORM\Mapping AS ORM;

use App\Interfaces\Primary;
use App\Entities\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="comments")
 */
class Comment extends \ArrayObject
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(name="id", type="integer")
	 * @var int $id
	 */
	protected $id;

	/**
	 * @ORM\Column(name="text", type="text")
	 * @var string $text
	 */
	protected $text;

	/**
	 * @ORM\Column(name="time_commented", type="datetime")
	 * @var \DateTime $timeCommented
	 */
	protected $timeCommented;

	/**
	 * @ORM\ManyToOne(targetEntity="Inspection", inversedBy="majorAssemblies", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var Inspection $inspection
	 */
	protected $inspection;

	/**
	 * @ORM\ManyToOne(targetEntity="InspectionMajorAssembly", inversedBy="comments", cascade={"persist"},
	 *                                                        fetch="EXTRA_LAZY")
	 * @var InspectionMajorAssembly $majorAssembly
	 */
	protected $majorAssembly;

	/**
	 * @ORM\ManyToOne(targetEntity="InspectionSubAssembly", inversedBy="comments", cascade={"persist"},
	 *                                                      fetch="EXTRA_LAZY")
	 * @var InspectionSubAssembly $subAssembly
	 */
	protected $subAssembly;

	/**
	 * @ORM\ManyToOne(targetEntity="MachineGeneralTest", inversedBy="comments", cascade={"persist"},
	 *                                                      fetch="EXTRA_LAZY")
	 * @var MachineGeneralTest $machineGeneralTest
	 */
	protected $machineGeneralTest;

	/**
	 * @ORM\ManyToOne(targetEntity="OilTest", inversedBy="comments", cascade={"persist"},
	 *                                                      fetch="EXTRA_LAZY")
	 * @var OilTest $oilTest
	 */
	protected $oilTest;

	/**
	 * @ORM\ManyToOne(targetEntity="WearTest", inversedBy="comments", cascade={"persist"},
	 *                                                      fetch="EXTRA_LAZY")
	 * @var WearTest $wearTest
	 */
	protected $wearTest;

	/**
	 * @ORM\ManyToOne(targetEntity="Technician", inversedBy="comments", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var Technician $technician
	 */
	protected $technician;

	/**
	 * @ORM\ManyToOne(targetEntity="DomainExpert", inversedBy="comments", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var DomainExpert $domainExpert
	 */
	protected $domainExpert;

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
	public function getText()
	{
		return $this->text;
	}

	/**
	 * @param string $text
	 *
	 * @return $this
	 */
	public function setText($text)
	{
		$this->text = $text;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getTimeCommented()
	{
		return $this->timeCommented;
	}

	/**
	 * @param \DateTime $timeCommented
	 *
	 * @return $this
	 */
	public function setTimeCommented($timeCommented)
	{
		$this->timeCommented = $timeCommented;

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
	 * @return InspectionSubAssembly
	 */
	public function getSubAssembly()
	{
		return $this->subAssembly;
	}

	/**
	 * @param InspectionSubAssembly $subAssembly
	 *
	 * @return $this
	 */
	public function setSubAssembly($subAssembly)
	{
		$this->subAssembly = $subAssembly;

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

	/**
	 * @return Technician
	 */
	public function getTechnician()
	{
		return $this->technician;
	}

	/**
	 * @param Technician $technician
	 *
	 * @return $this
	 */
	public function setTechnician($technician)
	{
		$this->technician = $technician;

		return $this;
	}

	/**
	 * @return DomainExpert
	 */
	public function getDomainExpert()
	{
		return $this->domainExpert;
	}

	/**
	 * @param DomainExpert $domainExpert
	 *
	 * @return $this
	 */
	public function setDomainExpert($domainExpert)
	{
		$this->domainExpert = $domainExpert;

		return $this;
	}

	/**
	 * @return Primary
	 */
	public function getAuthor()
	{
		if($this->getTechnician() != NULL)
		{
			return $this->getTechnician();
		}

		else if($this->getDomainExpert() != NULL)
		{
			return $this->getDomainExpert();
		}

		else
		{
			return NULL;
		}
	}

	/**
	 * @param Primary $author
	 *
	 * @return $this
	 * @throws \InvalidArgumentException
	 */
	public function setAuthor($author)
	{
		if($author instanceof Technician)
		{
			$this->setTechnician($author);
			$this->setDomainExpert(NULL);
		}

		else if($author instanceof DomainExpert)
		{
			$this->setTechnician(NULL);
			$this->setDomainExpert($author);
		}

		else
		{
			throw new \InvalidArgumentException('Comment author must be either a Technician or Domain Expert.');
		}

		return $this;
	}

	public function getAuthorType()
	{
		if($this->getTechnician() != NULL)
		{
			return User::TYPE_TECHNICIAN;
		}

		else if($this->getDomainExpert() != NULL)
		{
			return User::TYPE_DOMAIN_EXPERT;
		}

		else
		{
			return NULL;
		}
	}
}