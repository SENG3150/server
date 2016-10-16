<?php
namespace App\API\V1\Parsers;

use App\API\V1\Entities\Downtime as Entity;
use App\API\V1\Repositories\DowntimeRepository as Repository;
use App\Parsers\Parser;
use Illuminate\Http\Request;
use App;

class DowntimeParser extends Parser
{
	/** @var Repository $repository */
	var $repository;
	public function __construct()
	{
		parent::__construct();

		$this->repository = App::make(Repository::class);
	}
	
	public function create($input, $recursive = TRUE)
	{
		$input = $this->resolveInput($input);
		
		$this->validateArray(
			$input,
			array(
				'machine'       => 'required',
				'systemName'    => 'required',
				'downTimeHours' => 'required',
			)
		);
		
		$entity = new Entity();
		
		$this->resolve($entity, $input, 'machine', 'entity', App\API\V1\Repositories\MachineRepository::class);
		$this->resolve($entity, $input, 'systemName');
		$this->resolve($entity, $input, 'downTimeHours', 'double');
		$this->resolve($entity, $input, 'reason');
		
		$this->em->persist($entity);
		$this->em->flush();
		
		return $entity;
	}
	
	/**
	 * @param Request|array $input
	 * @param int           $id
	 * @param bool          $recursive
	 *
	 * @return Entity
	 */
	public function update($input, $id, $recursive = TRUE)
	{
		/** @var Entity $entity */
		$entity = $this->repository->find($id);
		
		if($entity != NULL)
		{
			$input = $this->resolveInput($input);
			
			$this->resolve($entity, $input, 'machine', 'entity', App\API\V1\Repositories\MachineRepository::class);
			$this->resolve($entity, $input, 'systemName');
			$this->resolve($entity, $input, 'downTimeHours', 'double');
			$this->resolve($entity, $input, 'reason');
			
			$this->em->persist($entity);
			$this->em->flush();
			
			return $entity;
		}
		
		else
		{
			throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
		}
	}
}