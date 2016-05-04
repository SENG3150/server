<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider as Provider;
use Tymon\JWTAuth\Contracts\Providers\Auth;

use App\Entities\User;

class UserProvider implements Provider, Auth
{
	const TYPE_ADMINISTRATOR = 'administrator';
	const TYPE_DOMAIN_EXPERT = 'domainExpert';
	const TYPE_TECHNICIAN = 'technician';
	
	/** @var  User $lastUser */
	protected $lastUser;
	
	public function __construct()
	{
		$this->lastUser = new User();
	}
	
	public function retrieveById($identifier)
	{
		$split    = explode('-', $identifier);
		$type     = $split[0];
		$username = NULL;

		if(count($split) > 1)
		{
			$username = join('-', array_slice($split, 1));
		}
		
		return $this->lastUser = $this->retrieveByFields($type, $username);
	}
	
	/**
	 * @param mixed  $identifier
	 * @param string $token
	 *
	 * @return void
	 */
	public function retrieveByToken($identifier, $token)
	{
		return;
	}
	
	/**
	 * @param \Illuminate\Contracts\Auth\Authenticatable $user
	 * @param string                                     $token
	 *
	 * @return void
	 */
	public function updateRememberToken(Authenticatable $user, $token)
	{
		return;
	}
	
	/**
	 * @param array $credentials
	 *
	 * @return \App\Entities\User
	 */
	public function retrieveByCredentials(array $credentials)
	{
		return $this->lastUser = $this->retrieveByFields($credentials['type'], $credentials['username']);
	}
	
	/**
	 * @param \Illuminate\Contracts\Auth\Authenticatable|User $user
	 * @param array                                           $credentials
	 *
	 * @return boolean
	 */
	public function validateCredentials(Authenticatable $user, array $credentials)
	{
		switch($credentials['type'])
		{
			case self::TYPE_ADMINISTRATOR:
			{
				return $user->isAdministrator() == TRUE && $user->getPrimary()->matchesPassword($credentials['password']);
			}
			
			case self::TYPE_DOMAIN_EXPERT:
			{
				return $user->isDomainExpert() == TRUE && $user->getPrimary()->matchesPassword($credentials['password']);
			}
			
			case self::TYPE_TECHNICIAN:
			{
				return $user->isTechnician() == TRUE && $user->getPrimary()->matchesPassword($credentials['password']);
			}
			
			default:
			{
				return FALSE;
			}
		}
	}
	
	public function retrieveByFields($type, $username)
	{
		$user = new User();

		$user
			->setId(join('-', array($type, $username)))
			->setType($type);

		return $user;
	}
	
	public function byId($id)
	{
		return $this->retrieveById($id);
	}
	
	public function byCredentials(array $credentials)
	{
		$user = $this->retrieveByCredentials($credentials);
		
		if($this->validateCredentials($user, $credentials) == FALSE)
		{
			return FALSE;
		}
		
		return $user;
	}
	
	public function user()
	{
		return $this->lastUser;
	}
}