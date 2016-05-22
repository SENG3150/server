<?php

namespace App\API\V1\Controllers;

use App\API\V1\Parsers\PhotoParser as Parser;
use App\API\V1\Repositories\PhotoRepository as Repository;
use App\API\V1\Transformers\PhotoTransformer as Transformer;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Response;

class PhotoController extends APIController
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

	public function photo($id, Repository $repository)
	{
		$entity = $repository->find($id);

		if($entity != NULL)
		{
			$photo = file_get_contents($entity->getFilePath());

			return Response::make(
				$photo,
				200,
				array(
					'Content-Type'        => 'image/' . $entity->getFormat(),
					'Content-Disposition' => 'inline; filename="' . $entity->getText() . '.' . $entity->getFormat() . '"',
				)
			);
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