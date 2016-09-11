<?php

namespace App\API\V1\Entities;

use App\Entities\Entity;
use App\Entities\Traits\Deletable;
use Doctrine\ORM\Mapping AS ORM;
use App\Interfaces\Primary;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="technicians")
 */
class Technician extends Entity implements Primary
{
	use Deletable;
	
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(name="id", type="integer")
	 * @var int $id
	 */
	protected $id;
	
	/**
	 * @ORM\Column(name="username", type="text")
	 * @var string $username
	 */
	protected $username;

	/**
	 * @ORM\Column(name="first_name", type="text")
	 * @var string $firstName
	 */
	protected $firstName;
	
	/**
	 * @ORM\Column(name="last_name", type="text")
	 * @var string $lastName
	 */
	protected $lastName;
	
	/**
	 * @ORM\Column(name="email", type="text")
	 * @var string $email
	 */
	protected $email;
	
	/**
	 * @ORM\Column(name="password", type="text")
	 * @var string $password
	 */
	protected $password;

	/**
	 * @ORM\Column(name="temporary", type="boolean")
	 * @var bool $temporary
	 */
	protected $temporary;

	/**
	 * @ORM\Column(name="login_expires_time", type="datetime", nullable=true)
	 * @var \DateTime $loginExpiresTime
	 */
	protected $loginExpiresTime;

	/**
	 * @ORM\OneToMany(targetEntity="Inspection", mappedBy="technician", cascade={"persist"}, fetch="EXTRA_LAZY")
	 * @var Inspection[]|ArrayCollection $inspections
	 */
	protected $inspections;
	
	/**
	 * @return int
	 *
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
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * @param string $username
	 *
	 * @return $this
	 */
	public function setUsername($username)
	{
		$this->username = $username;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getFirstName()
	{
		return $this->firstName;
	}

	/**
	 * @param string $firstName
	 *
	 * @return $this
	 */
	public function setFirstName($firstName)
	{
		$this->firstName = $firstName;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getLastName()
	{
		return $this->lastName;
	}

	/**
	 * @param string $lastName
	 *
	 * @return $this
	 */
	public function setLastName($lastName)
	{
		$this->lastName = $lastName;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @param string $email
	 *
	 * @return $this
	 */
	public function setEmail($email)
	{
		$this->email = $email;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @param string $password
	 *
	 * @return $this
	 */
	public function setPassword($password)
	{
		$this->password = password_hash($password, PASSWORD_BCRYPT);
		
		return $this;
	}

	/**
	 * @return boolean
	 */
	public function isTemporary()
	{
		return $this->temporary;
	}

	/**
	 * @param boolean $temporary
	 *
	 * @return $this
	 */
	public function setTemporary($temporary)
	{
		$this->temporary = $temporary;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getLoginExpiresTime()
	{
		return $this->loginExpiresTime;
	}

	/**
	 * @param \DateTime $loginExpiresTime
	 *
	 * @return $this
	 */
	public function setLoginExpiresTime($loginExpiresTime)
	{
		$this->loginExpiresTime = $loginExpiresTime;

		return $this;
	}
	
	/**
	 * @param bool $salutation
	 *
	 * @return string
	 */
	public function getName($salutation = FALSE)
	{
		return join(
			' ',
			array_filter(
				array(
					$this->getFirstName(),
					$this->getLastName(),
				)
			)
		);
	}
	
	/**
	 * @param string $password
	 *
	 * @return boolean
	 */
	public function matchesPassword($password)
	{
		return password_verify($password, $this->getPassword());
	}

	/**
	 * @return bool
	 */
	public function hasLoginExpired()
	{
		return $this->isTemporary() == TRUE && $this->getLoginExpiresTime() < (new \DateTime());
	}

	/**
	 * @return ArrayCollection|Inspection[]
	 */
	public function getInspections()
	{
		return $this->inspections;
	}

	/**
	 * @param ArrayCollection|Inspection[] $inspections
	 *
	 * @return $this
	 */
	public function setInspections($inspections)
	{
		$this->inspections = $inspections;

		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getEmailHash()
	{
		return md5(strtolower(trim($this->getEmail())));
	}
}