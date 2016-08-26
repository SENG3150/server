<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

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