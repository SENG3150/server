<?php

namespace App\API\V1\Controllers;

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
use App\Entities\Traits\Deletable;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Barryvdh\Snappy\PdfWrapper as PDF;

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
			if(hasTrait($entity, Deletable::class) == TRUE)
			{
				$entity->delete();
				
				$em->persist($entity);
				$em->flush();
				
				return $this->response()->accepted();
			}
			
			else
			{
				$this->response()->errorMethodNotAllowed();
				
				return FALSE;
			}
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
	
	public function bulk(Request $request, Repository $repository, Parser $parser, InspectionMajorAssemblyParser $inspectionMajorAssemblyParser, InspectionSubAssemblyParser $inspectionSubAssemblyParser, InspectionMajorAssemblyRepository $inspectionMajorAssemblyRepository, InspectionSubAssemblyRepository $inspectionSubAssemblyRepository, CommentParser $commentParser, MachineGeneralTestParser $machineGeneralTestParser, OilTestParser $oilTestParser, WearTestParser $wearTestParser, PhotoParser $photoParser, ActionItemParser $actionItemParser, EntityManagerInterface $em)
	{
		$technician = $this->getUser()->getTechnician();
		
		if($technician == NULL)
		{
			throw new \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException('You must be a technician to use this endpoint.');
		}
		
		$input = $request->input();
		
		$input['technician'] = $technician->getId();
		
		/** @var Inspection $entity */
		$entity = $parser->handle($input);
		
		// Check if this was a new inspection
		if(array_key_exists('id', $input) == FALSE)
		{
			if(array_key_exists('majorAssemblies', $input) == TRUE)
			{
				foreach($input['majorAssemblies'] as $majorAssemblyKey => $majorAssembly)
				{
					$majorAssembly['inspection'] = $entity->getId();
					
					/** @var InspectionMajorAssembly $majorAssemblyEntity */
					$majorAssemblyEntity = $inspectionMajorAssemblyParser->handle($majorAssembly);
					
					$input['majorAssemblies'][$majorAssemblyKey]['id'] = $majorAssemblyEntity->getId();
					
					if(array_key_exists('subAssemblies', $majorAssembly) == TRUE)
					{
						foreach($majorAssembly['subAssemblies'] as $subAssemblyKey => $subAssembly)
						{
							$subAssembly['inspection']    = $entity->getId();
							$subAssembly['majorAssembly'] = $majorAssemblyEntity->getId();
							
							/** @var InspectionSubAssembly $subAssemblyEntity */
							$subAssemblyEntity = $inspectionSubAssemblyParser->handle($subAssembly);
							
							$input['majorAssemblies'][$majorAssemblyKey]['subAssemblies'][$subAssemblyKey]['id'] = $subAssemblyEntity->getId();
							
							$em->detach($subAssemblyEntity);
						}
					}
					
					$em->detach($majorAssemblyEntity);
				}
			}
			
			$em->detach($entity);
			
			$entity = $repository->find($entity->getId());
		}
		
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
										$actionItem['technician'] = $technician->getId();
										
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
										$actionItem['technician'] = $technician->getId();
										
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
										$actionItem['technician'] = $technician->getId();
										
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
						'id'        => $inspectionSubAssembly->getId(),
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
								'smu'           => $wearTest->getSmu(),
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
	
	public function download($id, Request $request, PDF $pdf, Repository $repository)
	{
		$entity = $repository->find($id);
		
		if($entity != NULL)
		{
			$data = array(
				'inspection'      => $entity,
				'majorAssemblies' => json_decode($request->input('majorAssemblies'))
			);
			
			return $pdf->loadHTML(view('v1/inspections/report', $data)->render())->inline('Inspection ' . $id . ' - Report.pdf');
		}
		
		else
		{
			$this->response()->errorNotFound();
			
			return FALSE;
		}
	}
}