<?php

namespace App\API\V1\Controllers;

use App\API\V1\Parsers\CommentParser as Parser;
use App\API\V1\Repositories\CommentRepository as Repository;
use App\API\V1\Transformers\CommentTransformer as Transformer;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class CommentController extends APIController
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