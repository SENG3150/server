<?php

namespace App\API\V1\Controllers;

use App\API\V1\Entities\Inspection;
use App\API\V1\Entities\InspectionMajorAssembly;
use App\API\V1\Entities\InspectionSubAssembly;
use App\API\V1\Parsers\InspectionParser as Parser;
use App\API\V1\Parsers\InspectionMajorAssemblyParser;
use App\API\V1\Parsers\InspectionSubAssemblyParser;
use App\API\V1\Repositories\InspectionRepository as Repository;
use App\API\V1\Transformers\InspectionTransformer as Transformer;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class InspectionController extends APIController
{
	public function getList(Repository $repository)
	{
		$entities = $repository->findAll();

		return $this->response->collection(Collection::make($entities), new Transformer());
	}

	public function get($id, Repository $repository)
	{
		$entity = $repository->find($id);

		if($entity != NULL)
		{
			return $this->response->item($entity, new Transformer());
		}

		else
		{
			$this->response()->errorNotFound();

			return FALSE;
		}
	}

	public function create(Request $request, Parser $parser)
	{
		$parser->handle($request);

		return $this->response()->created();
	}

	public function update($id, Request $request, Parser $parser)
	{
		$parser->handle($request, $id);

		return $this->response()->accepted();
	}

	public function delete($id, Repository $repository, EntityManagerInterface $em)
	{
		$entity = $repository->find($id);

		if($entity != NULL)
		{
			$em->remove($entity);
			$em->flush();

			return $this->response()->accepted();
		}

		else
		{
			$this->response()->errorNotFound();

			return FALSE;
		}
	}

	public function getIncompleteList(Repository $repository)
	{
		$entities = $repository->findBy(
			array(
				'timeCompleted' => NULL
			)
		);

		return $this->response->collection(Collection::make($entities), new Transformer());
	}

	public function createBulk(Request $request, Parser $parser, InspectionMajorAssemblyParser $inspectionMajorAssemblyParser, InspectionSubAssemblyParser $inspectionSubAssemblyParser)
	{
		/** @var Inspection $entity */
		$entity = $parser->handle($request);

		$input = $request->input();

		if(array_key_exists('majorAssemblies', $input) == TRUE)
		{
			foreach($input['majorAssemblies'] as $majorAssembly)
			{
				$majorAssembly['inspection'] = $entity->getId();

				/** @var InspectionMajorAssembly $majorAssemblyEntity */
				$majorAssemblyEntity = $inspectionMajorAssemblyParser->handle($majorAssembly);

				if(array_key_exists('subAssemblies', $majorAssembly) == TRUE)
				{
					foreach($majorAssembly['subAssemblies'] as $subAssembly)
					{
						$subAssembly['inspection']    = $entity->getId();
						$subAssembly['majorAssembly'] = $majorAssemblyEntity->getId();

						/** @var InspectionSubAssembly $subAssemblyEntity */
						$subAssemblyEntity = $inspectionSubAssemblyParser->handle($subAssembly);
					}
				}
			}
		}
	}

	public function graphs($id, Repository $repository)
	{
		$entity = $repository->find($id);

		if($entity != NULL)
		{
			$output = array(
				'subAssemblies' => array()
			);

			/** @var InspectionMajorAssembly $inspectionMajorAssembly */
			foreach($entity->getMajorAssemblies() as $inspectionMajorAssembly)
			{
				foreach($inspectionMajorAssembly->getSubAssemblies() as $inspectionSubAssembly)
				{
					$line = array(
						'name'      => $inspectionSubAssembly->getSubAssembly()->getName(),
						'oilTests'  => array(),
						'wearTests' => array(),
					);

					$subAssembly = $inspectionSubAssembly->getSubAssembly();

					foreach($subAssembly->getInspections() as $inspection)
					{
						if($inspection->getOilTest() != NULL)
						{
							$oilTest = $inspection->getOilTest();

							$line['oilTests'][] = array(
								'timeCompleted' => $oilTest->getInspection()->getTimeCompleted()->format(DATE_ISO8601),
								'lead'          => $oilTest->getLead(),
								'copper'        => $oilTest->getCopper(),
								'tin'           => $oilTest->getTin(),
								'iron'          => $oilTest->getIron(),
								'pq90'          => $oilTest->getPq90(),
								'silicon'       => $oilTest->getSilicon(),
								'sodium'        => $oilTest->getSodium(),
								'aluminium'     => $oilTest->getAluminium(),
								'water'         => $oilTest->getWater(),
								'viscosity'     => $oilTest->getViscosity(),
							);
						}
						
						if($inspection->getWearTest() != NULL)
						{
							$wearTest = $inspection->getWearTest();

							$line['wearTests'][] = array(
								'timeCompleted' => $wearTest->getInspection()->getTimeCompleted()->format(DATE_ISO8601),
								'description'   => $wearTest->getDescription(),
								'new'           => $wearTest->getNew(),
								'limit'         => $wearTest->getLimit(),
								'lifeLower'     => $wearTest->getLifeLower(),
								'lifeUpper'     => $wearTest->getLifeUpper(),
								'smu'           => $wearTest->getSmu(),
								'timeStart'     => $wearTest->getTimeStart()->format(DATE_ISO8601),
								'uniqueDetails' => $wearTest->getUniqueDetails(),
							);
						}
					}

					$output['subAssemblies'][] = $line;
				}
			}

			return response()->json($output);
		}

		else
		{
			$this->response()->errorNotFound();

			return FALSE;
		}
	}
}