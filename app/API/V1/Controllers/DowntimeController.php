<?php

namespace App\API\V1\Controllers;

use App\API\V1\Parsers\DowntimeParser as Parser;
use App\API\V1\Repositories\DowntimeRepository as Repository;
use App\API\V1\Transformers\DowntimeTransformer as Transformer;
use App\Entities\Traits\Deletable;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\API\V1\Repositories\MachineRepository;


class  DowntimeController extends APIController
{
    public function getList(Repository $repository)
    {
        $entities = $repository->findAll();

        return $this->response->collection(Collection::make($entities), new Transformer());
    }

    public function get($id, Repository $repository)
    {
        $entity = $repository->find($id);

        if ($entity != NULL) {
            return $this->response->item($entity, new Transformer());
        } else {
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

    public function machine($id, Repository $repository, MachineRepository $machineRepository)
    {
        $machine = $machineRepository->find($id);

        if ($machine != NULL) {
            $items = $repository->findByMachine($machine);

            return $this->response->collection(Collection::make($items), new Transformer());
        } else {
            $this->response()->errorNotFound();

            return FALSE;
        }
    }

    public function createBulk(Request $request, Parser $parser)
    {
        $input = $request->input();

        if (array_key_exists('data', $input) == TRUE) {
            foreach ($input['data'] as $item) {
                $item['machine'] = $input['machine'];

                /** @var Downtime $downtimeEntity */
                $downtimeEntity = $parser->handle($item);
            }
        }

        return $this->response->created();
    }
}