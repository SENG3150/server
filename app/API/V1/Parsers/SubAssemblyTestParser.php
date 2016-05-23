<?php

namespace App\API\V1\Parsers;

use App\API\V1\Entities\SubAssemblyTest as Entity;
use App\API\V1\Repositories\SubAssemblyTestRepository as Repository;
use Illuminate\Http\Request;
use App;

class SubAssemblyTestParser extends Parser
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
				'subAssembly'          => 'required',
				'machineGeneral.test'  => 'required|bool',
				'machineGeneral.lower' => 'required',
				'machineGeneral.upper' => 'required',
				'oilTest.test'         => 'required|bool',
				'oilTest.lower'        => 'required',
				'oilTest.upper'        => 'required',
				'wearTest.test'        => 'required|bool',
				'wearTest.lower'       => 'required',
				'wearTest.upper'       => 'required',
			)
		);

		$entity = new Entity();

		$this->resolve($entity, $input, 'subAssembly', 'entity', App\API\V1\Repositories\SubAssemblyRepository::class);

		$machineGeneralTest = $input['machineGeneral'];
		$oilTest            = $input['oil'];
		$wearTest           = $input['wear'];

		$entity
			->setMachineGeneral($machineGeneralTest['test'])
			->setMachineGeneralLower($machineGeneralTest['lower'])
			->setMachineGeneralUpper($machineGeneralTest['upper']);

		$entity
			->setOil($oilTest['test'])
			->setOilLower($oilTest['lower'])
			->setOilUpper($oilTest['upper']);

		$entity
			->setWear($wearTest['test'])
			->setWearLower($wearTest['lower'])
			->setWearUpper($wearTest['upper']);

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

			$this->resolve($entity, $input, 'subAssembly', 'entity', App\API\V1\Repositories\SubAssemblyRepository::class);

			if(array_key_exists('machineGeneral', $input) == TRUE)
			{
				$machineGeneralTest = $input['machineGeneral'];

				if(array_key_exists('test', $machineGeneralTest) == TRUE)
				{
					$entity
						->setMachineGeneral(boolval($machineGeneralTest['test']));
				}

				if(array_key_exists('lower', $machineGeneralTest) == TRUE)
				{
					$entity
						->setMachineGeneralLower($machineGeneralTest['lower']);
				}

				if(array_key_exists('upper', $machineGeneralTest) == TRUE)
				{
					$entity
						->setMachineGeneralUpper($machineGeneralTest['upper']);
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

				if(array_key_exists('lower', $oilTest) == TRUE)
				{
					$entity
						->setOilLower($oilTest['lower']);
				}

				if(array_key_exists('upper', $oilTest) == TRUE)
				{
					$entity
						->setOilUpper($oilTest['upper']);
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

				if(array_key_exists('lower', $wearTest) == TRUE)
				{
					$entity
						->setWearLower($wearTest['lower']);
				}

				if(array_key_exists('upper', $wearTest) == TRUE)
				{
					$entity
						->setWearUpper($wearTest['upper']);
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