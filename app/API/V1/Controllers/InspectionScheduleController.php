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
use Barryvdh\Snappy\PdfWrapper as PDF;

class InspectionScheduleController extends APIController
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
}