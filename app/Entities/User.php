<?php

namespace App\Entities;

use App\Interfaces\Primary;
use Doctrine\ORM\EntityNotFoundException;
use LaravelDoctrine\ORM\Contracts\Auth\Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends \ArrayObject implements Authenticatable, JWTSubject
{
	const TYPE_ADMINISTRATOR = 'administrator';
	const TYPE_DOMAIN_EXPERT = 'domainExpert';
	const TYPE_TECHNICIAN = 'technician';
	
	/** @var  string $id */
	protected $id;
	
	/** @var  string $username */
	protected $username;
	
	/** @var  string $type */
	protected $type;
	
	/** @var  Administrator $administrator */
	protected $administrator;
	
	/** @var  DomainExpert $domainExpert */
	protected $domainExpert;
	
	/** @var  Technician $technician */
	protected $technician;
	
	/**
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * @param string $id
	 *
	 * @return $this
	 */
	public function setId($id)
	{
		$this->id = $id;
		
		$split = explode('-', $id);

		if(count($split) > 1)
		{
			$this->username = join('-', array_slice($split, 1));
		}
		
		return $this;
	}
	
	/**
	 * @return \App\Interfaces\Primary
	 * @throws \Exception
	 */
	public function getPrimary()
	{
		switch($this->type)
		{
			case $this::TYPE_ADMINISTRATOR:
			{
				return $this->getAdministrator();
			}
			
			case $this::TYPE_DOMAIN_EXPERT:
			{
				return $this->getDomainExpert();
			}
			
			case $this::TYPE_TECHNICIAN:
			{
				return $this->getTechnician();
			}
			
			default:
			{
				throw new \Exception('Type not found.');
			}
		}
	}
	
	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}
	
	/**
	 * @param string $type
	 *
	 * @return $this
	 */
	public function setType($type)
	{
		$this->type = $type;
		
		return $this;
	}
	
	/**
	 * @return string
	 * @throws \Exception
	 */
	public function getTypeString()
	{
		switch($this->type)
		{
			case $this::TYPE_ADMINISTRATOR:
			{
				return 'Administrator';
			}
			
			case $this::TYPE_DOMAIN_EXPERT:
			{
				return 'Domain Expert';
			}
			
			case $this::TYPE_TECHNICIAN:
			{
				return 'Technician';
			}
			
			default:
			{
				throw new \Exception('Type not found.');
			}
		}
	}
	
	/**
	 * @return Primary|Administrator
	 *
	 * @throws EntityNotFoundException
	 */
	public function getAdministrator()
	{
		if($this->isAdministrator() == TRUE && $this->administrator == NULL)
		{
			$this->administrator = app('AdministratorRepository')->findOneByUsername($this->username);
			
			if($this->administrator == NULL)
			{
				throw new EntityNotFoundException('No Administrator with username "' . $this->username . '" found.');
			}
		}
		
		return $this->administrator;
	}
	
	/**
	 * @param Primary|Administrator $administrator
	 *
	 * @return $this
	 */
	public function setAdministrator($administrator)
	{
		$this->administrator = $administrator;
		
		return $this;
	}
	
	/**
	 * @return Primary|DomainExpert
	 *
	 * @throws EntityNotFoundException
	 */
	public function getDomainExpert()
	{
		if($this->isDomainExpert() == TRUE && $this->domainExpert == NULL)
		{
			$this->domainExpert = app('DomainExpertRepository')->findOneByUsername($this->username);
			
			if($this->domainExpert == NULL)
			{
				throw new EntityNotFoundException('No Domain Expert with username "' . $this->username . '" found.');
			}
		}
		
		return $this->domainExpert;
	}
	
	/**
	 * @param Primary|DomainExpert $domainExpert
	 *
	 * @return $this
	 */
	public function setDomainExpert($domainExpert)
	{
		$this->domainExpert = $domainExpert;
		
		return $this;
	}
	
	/**
	 * @return Primary|Technician
	 *
	 * @throws EntityNotFoundException
	 */
	public function getTechnician()
	{
		if($this->isTechnician() == TRUE && $this->technician == NULL)
		{
			$this->technician = app('TechnicianRepository')->findOneByUsername($this->username);
			
			if($this->technician == NULL)
			{
				throw new EntityNotFoundException('No Technician with username "' . $this->username . '"" found.');
			}
		}
		
		return $this->technician;
	}
	
	/**
	 * @param Primary|Technician $technician
	 *
	 * @return $this
	 */
	public function setTechnician($technician)
	{
		$this->technician = $technician;
		
		return $this;
	}
	
	/**
	 * @return bool
	 */
	public function isAdministrator()
	{
		return $this->type == $this::TYPE_ADMINISTRATOR;
	}
	
	/**
	 * @return bool
	 */
	public function isDomainExpert()
	{
		return $this->type == $this::TYPE_DOMAIN_EXPERT;
	}
	
	/**
	 * @return bool
	 */
	public function isTechnician()
	{
		return $this->type == $this::TYPE_TECHNICIAN;
	}
	
	public function getAuthIdentifierName()
	{
		return 'id';
	}
	
	public function getAuthIdentifier()
	{
		return $this->getId();
	}
	
	public function getAuthPassword()
	{
		return $this->getPrimary()->getPassword();
	}
	
	public function getRememberToken()
	{
		return;
	}
	
	public function setRememberToken($value)
	{
		return;
	}
	
	public function getRememberTokenName()
	{
		return;
	}
	
	public function getJWTIdentifier()
	{
		return $this->getId();
	}
	
	public function getJWTCustomClaims()
	{
		return [];
	}
}