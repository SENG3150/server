<?php

namespace App\API\V1\Entities;

use Doctrine\ORM\Mapping AS ORM;

use App\Interfaces\Primary;
use App\Entities\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="photos")
 */
class Photo extends \ArrayObject
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
	 * @ORM\Column(name="format", type="text")
	 * @var string $format
	 */
	protected $format;

	/**
	 * @ORM\ManyToOne(targetEntity="Inspection", inversedBy="photos", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var Inspection $inspection
	 */
	protected $inspection;

	/**
	 * @ORM\ManyToOne(targetEntity="InspectionMajorAssembly", inversedBy="photos", cascade={"persist"},
	 *                                                        fetch="EXTRA_LAZY")
	 * @var InspectionMajorAssembly $majorAssembly
	 */
	protected $majorAssembly;

	/**
	 * @ORM\ManyToOne(targetEntity="InspectionSubAssembly", inversedBy="photos", cascade={"persist"},
	 *                                                      fetch="EXTRA_LAZY")
	 * @var InspectionSubAssembly $subAssembly
	 */
	protected $subAssembly;

	/**
	 * @ORM\ManyToOne(targetEntity="MachineGeneralTest", inversedBy="photos", cascade={"persist"},
	 *                                                      fetch="EXTRA_LAZY")
	 * @var MachineGeneralTest $machineGeneralTest
	 */
	protected $machineGeneralTest;

	/**
	 * @ORM\ManyToOne(targetEntity="OilTest", inversedBy="photos", cascade={"persist"},
	 *                                                      fetch="EXTRA_LAZY")
	 * @var OilTest $oilTest
	 */
	protected $oilTest;

	/**
	 * @ORM\ManyToOne(targetEntity="WearTest", inversedBy="photos", cascade={"persist"},
	 *                                                      fetch="EXTRA_LAZY")
	 * @var WearTest $wearTest
	 */
	protected $wearTest;

	/**
	 * @ORM\ManyToOne(targetEntity="Technician", inversedBy="photos", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var Technician $technician
	 */
	protected $technician;

	/**
	 * @ORM\ManyToOne(targetEntity="DomainExpert", inversedBy="photos", cascade={"persist"}, fetch="EXTRA_LAZY")
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
	 * @return string
	 */
	public function getFormat()
	{
		return $this->format;
	}

	/**
	 * @param string $format
	 *
	 * @return $this
	 */
	public function setFormat($format)
	{
		$this->format = $format;

		return $this;
	}

	/**
	 * @return \App\API\V1\Entities\Inspection
	 */
	public function getInspection()
	{
		return $this->inspection;
	}

	/**
	 * @param \App\API\V1\Entities\Inspection $inspection
	 *
	 * @return $this
	 */
	public function setInspection($inspection)
	{
		$this->inspection = $inspection;

		return $this;
	}

	/**
	 * @return \App\API\V1\Entities\InspectionMajorAssembly
	 */
	public function getMajorAssembly()
	{
		return $this->majorAssembly;
	}

	/**
	 * @param \App\API\V1\Entities\InspectionMajorAssembly $majorAssembly
	 *
	 * @return $this
	 */
	public function setMajorAssembly($majorAssembly)
	{
		$this->majorAssembly = $majorAssembly;

		return $this;
	}

	/**
	 * @return \App\API\V1\Entities\InspectionSubAssembly
	 */
	public function getSubAssembly()
	{
		return $this->subAssembly;
	}

	/**
	 * @param \App\API\V1\Entities\InspectionSubAssembly $subAssembly
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
	 * @return \App\API\V1\Entities\Technician
	 */
	public function getTechnician()
	{
		return $this->technician;
	}

	/**
	 * @param \App\API\V1\Entities\Technician $technician
	 *
	 * @return $this
	 */
	public function setTechnician($technician)
	{
		$this->technician = $technician;

		return $this;
	}

	/**
	 * @return \App\API\V1\Entities\DomainExpert
	 */
	public function getDomainExpert()
	{
		return $this->domainExpert;
	}

	/**
	 * @param \App\API\V1\Entities\DomainExpert $domainExpert
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
			throw new \InvalidArgumentException('Photo author must be either a Technician or Domain Expert.');
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

	public function getFilePath()
	{
		return storage_path('app/public/photos/' . $this->id . '.' . $this->format);
	}

	public function getURLPath()
	{
		if(strpos(config('app.url'), 'https://') === 0)
		{
			return secure_asset('photos/' . $this->id . '/photo');
		}

		else
		{
			return url('photos/' . $this->id . '/photo');
		}
	}
}