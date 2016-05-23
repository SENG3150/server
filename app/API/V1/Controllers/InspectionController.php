<?php

namespace App\API\V1\Controllers;

use App\API\V1\Entities\ActionItem;
use App\API\V1\Entities\Inspection;
use App\API\V1\Entities\InspectionMajorAssembly;
use App\API\V1\Entities\InspectionSubAssembly;
use App\API\V1\Entities\MachineGeneralTest;
use App\API\V1\Entities\OilTest;
use App\API\V1\Entities\WearTest;
use App\API\V1\Parsers\ActionItemParser;
use App\API\V1\Parsers\CommentParser;
use App\API\V1\Parsers\InspectionParser as Parser;
use App\API\V1\Parsers\InspectionMajorAssemblyParser;
use App\API\V1\Parsers\InspectionSubAssemblyParser;
use App\API\V1\Parsers\MachineGeneralTestParser;
use App\API\V1\Parsers\OilTestParser;
use App\API\V1\Parsers\PhotoParser;
use App\API\V1\Parsers\WearTestParser;
use App\API\V1\Repositories\InspectionMajorAssemblyRepository;
use App\API\V1\Repositories\InspectionRepository as Repository;
use App\API\V1\Repositories\InspectionSubAssemblyRepository;
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

	public function updateBulk($id, Request $request, Parser $parser, InspectionMajorAssemblyRepository $inspectionMajorAssemblyRepository, InspectionSubAssemblyRepository $inspectionSubAssemblyRepository, CommentParser $commentParser, MachineGeneralTestParser $machineGeneralTestParser, OilTestParser $oilTestParser, WearTestParser $wearTestParser, PhotoParser $photoParser, ActionItemParser $actionItemParser)
	{
		$technician = $this->getUser()->getTechnician();

		if($technician == NULL)
		{
			throw new \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException('You must be a technician to use this endpoint.');
		}

		$input = $request->input();

		$input['technician'] = $technician->getId();

		/** @var Inspection $entity */
		$entity = $parser->handle($input, $id);

		if(array_key_exists('comments', $input) == TRUE)
		{
			foreach($input['comments'] as $comment)
			{
				$comment['inspection'] = $entity->getId();
				$comment['technician'] = $technician->getId();

				$commentEntity = $commentParser->handle($comment);
			}
		}

		if(array_key_exists('photos', $input) == TRUE)
		{
			foreach($input['photos'] as $photo)
			{
				$photo['inspection'] = $entity->getId();
				$photo['technician'] = $technician->getId();

				$photoEntity = $photoParser->handle($photo);
			}
		}

		if(array_key_exists('majorAssemblies', $input) == TRUE)
		{
			foreach($input['majorAssemblies'] as $majorAssembly)
			{
				$majorAssemblyEntity = $inspectionMajorAssemblyRepository->find($majorAssembly['id']);

				if($majorAssemblyEntity != NULL)
				{
					if(array_key_exists('comments', $majorAssembly) == TRUE)
					{
						foreach($majorAssembly['comments'] as $comment)
						{
							$comment['majorAssembly'] = $majorAssemblyEntity->getId();
							$comment['technician']    = $technician->getId();

							$commentEntity = $commentParser->handle($comment);
						}
					}

					if(array_key_exists('photos', $majorAssembly) == TRUE)
					{
						foreach($majorAssembly['photos'] as $photo)
						{
							$photo['majorAssembly'] = $majorAssemblyEntity->getId();
							$photo['technician']    = $technician->getId();

							$photoEntity = $photoParser->handle($photo);
						}
					}

					if(array_key_exists('subAssemblies', $majorAssembly) == TRUE)
					{
						foreach($majorAssembly['subAssemblies'] as $subAssembly)
						{
							$subAssemblyEntity = $inspectionSubAssemblyRepository->find($subAssembly['id']);

							if($subAssemblyEntity != NULL)
							{
								if(array_key_exists('comments', $subAssembly) == TRUE)
								{
									foreach($subAssembly['comments'] as $comment)
									{
										$comment['subAssembly'] = $subAssemblyEntity->getId();
										$comment['technician']  = $technician->getId();

										$commentEntity = $commentParser->handle($comment);
									}
								}

								if(array_key_exists('photos', $subAssembly) == TRUE)
								{
									foreach($subAssembly['photos'] as $photo)
									{
										$photo['subAssembly'] = $subAssemblyEntity->getId();
										$photo['technician']  = $technician->getId();

										$photoEntity = $photoParser->handle($photo);
									}
								}

								if(array_key_exists('machineGeneralTest', $subAssembly) == TRUE && $subAssembly['machineGeneralTest'] != NULL)
								{
									$machineGeneralTest = $subAssembly['machineGeneralTest'];

									$machineGeneralTest['inspection']  = $entity->getId();
									$machineGeneralTest['subAssembly'] = $subAssemblyEntity->getId();

									/** @var MachineGeneralTest $machineGeneralTestEntity */
									$machineGeneralTestEntity = $machineGeneralTestParser->handle($machineGeneralTest);

									if(array_key_exists('comments', $machineGeneralTest) == TRUE)
									{
										foreach($machineGeneralTest['comments'] as $comment)
										{
											$comment['machineGeneralTest'] = $machineGeneralTestEntity->getId();
											$comment['technician']         = $technician->getId();

											$commentEntity = $commentParser->handle($comment);
										}
									}
									
									if(array_key_exists('photos', $machineGeneralTest) == TRUE)
									{
										foreach($machineGeneralTest['photos'] as $photo)
										{
											$photo['machineGeneralTest'] = $machineGeneralTestEntity->getId();
											$photo['technician']         = $technician->getId();

											$photoEntity = $photoParser->handle($photo);
										}
									}

									if(array_key_exists('actionItem', $machineGeneralTest) == TRUE && $machineGeneralTest['actionItem'] != NULL)
									{
										$actionItem = $machineGeneralTest['actionItem'];

										$actionItem['machineGeneralTest'] = $machineGeneralTestEntity->getId();

										$actionItemEntity = $actionItemParser->handle($actionItem);
									}
								}

								if(array_key_exists('oilTest', $subAssembly) == TRUE && $subAssembly['oilTest'] != NULL)
								{
									$oilTest = $subAssembly['oilTest'];

									$oilTest['inspection']  = $entity->getId();
									$oilTest['subAssembly'] = $subAssemblyEntity->getId();

									/** @var OilTest $oilTestEntity */
									$oilTestEntity = $oilTestParser->handle($oilTest);

									if(array_key_exists('comments', $oilTest) == TRUE)
									{
										foreach($oilTest['comments'] as $comment)
										{
											$comment['oilTest']    = $oilTestEntity->getId();
											$comment['technician'] = $technician->getId();

											$commentEntity = $commentParser->handle($comment);
										}
									}

									if(array_key_exists('photos', $oilTest) == TRUE)
									{
										foreach($oilTest['photos'] as $photo)
										{
											$photo['oilTest']    = $oilTestEntity->getId();
											$photo['technician'] = $technician->getId();

											$photoEntity = $photoParser->handle($photo);
										}
									}

									if(array_key_exists('actionItem', $oilTest) == TRUE && $oilTest['actionItem'] != NULL)
									{
										$actionItem = $oilTest['actionItem'];

										$actionItem['oilTest'] = $oilTestEntity->getId();

										$actionItemEntity = $actionItemParser->handle($actionItem);
									}
								}

								if(array_key_exists('wearTest', $subAssembly) == TRUE && $subAssembly['wearTest'] != NULL)
								{
									$wearTest = $subAssembly['wearTest'];

									$wearTest['inspection']  = $entity->getId();
									$wearTest['subAssembly'] = $subAssemblyEntity->getId();

									/** @var WearTest $wearTestEntity */
									$wearTestEntity = $wearTestParser->handle($wearTest);

									if(array_key_exists('comments', $wearTest) == TRUE)
									{
										foreach($wearTest['comments'] as $comment)
										{
											$comment['wearTest']   = $wearTestEntity->getId();
											$comment['technician'] = $technician->getId();

											$commentEntity = $commentParser->handle($comment);
										}
									}

									if(array_key_exists('photos', $wearTest) == TRUE)
									{
										foreach($wearTest['photos'] as $photo)
										{
											$photo['wearTest']   = $wearTestEntity->getId();
											$photo['technician'] = $technician->getId();

											$photoEntity = $photoParser->handle($photo);
										}
									}

									if(array_key_exists('actionItem', $wearTest) == TRUE && $wearTest['actionItem'] != NULL)
									{
										$actionItem = $wearTest['actionItem'];

										$actionItem['wearTest'] = $wearTestEntity->getId();

										$actionItemEntity = $actionItemParser->handle($actionItem);
									}
								}
							}

							else
							{
							}
						}
					}
				}

				else
				{
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