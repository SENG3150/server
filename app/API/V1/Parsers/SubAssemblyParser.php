<?php

namespace App\API\V1\Parsers;

use App\API\V1\Entities\SubAssembly as Entity;
use App\API\V1\Repositories\SubAssemblyRepository as Repository;
use Illuminate\Http\Request;
use App;

class SubAssemblyParser extends Parser
{
	/** @var Repository $repository */
	var $repository;

	public function __construct()
	{
		parent::__construct();

		$this->repository = App::make(Repository::class);
	}

	/**
	 * @param Request|array $input
	 * @param bool          $recursive
	 *
	 * @return Entity
	 */
	public function create($input, $recursive = TRUE)
	{
		$input = $this->resolveInput($input);

		$this->validateArray(
			$input,
			array(
				'majorAssembly' => 'required',
				'name'          => 'required',
				'machineGeneral.test'  => 'required|bool',
				'oilTest.test'         => 'required|bool',
				'wearTest.test'        => 'required|bool',
			)
		);

		$entity = new Entity();

		$this->resolve($entity, $input, 'majorAssembly', 'entity', App\API\V1\Repositories\MajorAssemblyRepository::class);
		$this->resolve($entity, $input, 'name');
		$machineGeneralTest = $input['machineGeneral'];
		$oilTest            = $input['oil'];
		$wearTest           = $input['wear'];

		$entity
			->setMachineGeneral($machineGeneralTest['test']);

		$entity
			->setOil($oilTest['test']);

		$entity
			->setWear($wearTest['test']);

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

			$this->resolve($entity, $input, 'majorAssembly', 'entity', App\API\V1\Repositories\MajorAssemblyRepository::class);
			$this->resolve($entity, $input, 'name');

			if(array_key_exists('machineGeneral', $input) == TRUE)
			{
				$machineGeneralTest = $input['machineGeneral'];

				if(array_key_exists('test', $machineGeneralTest) == TRUE)
				{
					$entity
						->setMachineGeneral(boolval($machineGeneralTest['test']));
				}

			}

			if(array_key_exists('oil', $input) == TRUE)
			{
				$oilTest = $input['oil'];

				if(array_key_exists('test', $oilTest) == TRUE)
				{
					$entity
						->setOil(boolval($oilTest['test']));
				}
			}

			if(array_key_exists('wear', $input) == TRUE)
			{
				$wearTest = $input['wear'];

				if(array_key_exists('test', $wearTest) == TRUE)
				{
					$entity
						->setWear(boolval($wearTest['test']));
				}
			}
			
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