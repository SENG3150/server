<?php

namespace App\API\V1\Transformers;

use App\Entities\User;
use League\Fractal\TransformerAbstract;

use App\API\V1\Entities\Photo;

class Transformer extends TransformerAbstract
{
	public function item($data, $transformer, $resourceKey = null)
	{
		if($data != NULL)
		{
			return parent::item($data, $transformer, $resourceKey);
		}

		else
		{
			return NULL;
		}
	}

	public function collection($data, $transformer, $resourceKey = null)
	{
		if($data != NULL)
		{
			return parent::collection($data, $transformer, $resourceKey);
		}

		else
		{
			return NULL;
		}
	}
}