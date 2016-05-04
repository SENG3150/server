<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\Entities\User;

class UserTransformer extends TransformerAbstract
{
	/**
	 * @var array
	 */
	protected $availableIncludes = array(
		'primary',
		'administrator',
		'domainExpert',
		'technician',
	);

	/**
	 * @var array
	 */
	protected $defaultIncludes = array(
		'primary',
		'administrator',
		'domainExpert',
		'technician',
	);

	/**
	 * @param \App\Entities\User $user
	 *
	 * @return array
	 */
	public function transform(User $user)
	{
		return array(
			'id'            => $user->getId(),
			'type'          => $user->getType(),
		);
	}

	public function includePrimary(User $user)
	{
		if($user->isAdministrator() == TRUE)
		{
			return $this->includeAdministrator($user);
		}

		else if($user->isDomainExpert() == TRUE)
		{
			return $this->includeDomainExpert($user);
		}

		else if($user->isTechnician() == TRUE)
		{
			return $this->includeTechnician($user);
		}

		else
		{
			return NULL;
		}
	}

	public function includeAdministrator(User $user)
	{
		if($user->isAdministrator() == TRUE)
		{
			return $this->item($user->getAdministrator(), app('AdministratorTransformer'));
		}

		else
		{
			return NULL;
		}
	}

	public function includeDomainExpert(User $user)
	{
		if($user->isDomainExpert() == TRUE)
		{
			return $this->item($user->getDomainExpert(), app('DomainExpertTransformer'));
		}

		else
		{
			return NULL;
		}
	}

	public function includeTechnician(User $user)
	{
		if($user->isTechnician() == TRUE)
		{
			return $this->item($user->getTechnician(), app('TechnicianTransformer'));
		}

		else
		{
			return NULL;
		}
	}
}