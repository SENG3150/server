<?php

namespace App\Repositories;

use Doctrine\ORM\EntityRepository;

class Repository extends EntityRepository
{
	public function __construct(\Doctrine\ORM\EntityManager $em, \Doctrine\ORM\Mapping\ClassMetadata $class)
	{
		parent::__construct($em, $class);
		
		$this->excludeDeleted();
	}
	
	public function excludeDeleted()
	{
		$this->getEntityManager()->getFilters()->enable('deletable');
		
		return $this;
	}
	
	public function includeDeleted()
	{
		$this->getEntityManager()->getFilters()->disable('deletable');
		
		return $this;
	}
}