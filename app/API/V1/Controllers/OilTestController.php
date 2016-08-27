<?php

namespace App\API\V1\Controllers;

use App\API\V1\Parsers\OilTestParser as Parser;
use App\API\V1\Repositories\OilTestRepository as Repository;
use App\API\V1\Transformers\OilTestTransformer as Transformer;
use App\Entities\Traits\Deletable;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class OilTestController extends APIController
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
}