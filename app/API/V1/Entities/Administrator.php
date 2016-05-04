<?php

namespace App\API\V1\Entities;

use Doctrine\ORM\Mapping AS ORM;
use App\Interfaces\Primary;

/**
 * @ORM\Entity
 * @ORM\Table(name="administrators")
 */
class Administrator extends \ArrayObject implements Primary
{
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
		$this->password = $password;

		return $this;
	}
	
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
}