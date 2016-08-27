<?php

namespace App\API\V1\Transformers;

use App\Entities\User;

use App\API\V1\Entities\Photo as Entity;
use App\Transformers\Transformer;

class PhotoTransformer extends Transformer
{
	/**
	 * @var array
	 */
	protected $availableIncludes = array(
		'inspection',
		'majorAssembly',
		'subAssembly',
		'technician',
		'domainExpert',
		'author',
		'raw',
	);
	
	/**
	 * @var array
	 */
	protected $defaultIncludes = array(
		'author',
	);
	
	/**
	 * @param Entity $entity
	 *
	 * @return array
	 */
	public function transform(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return array(
				'id'         => $entity->getId(),
				'authorType' => $entity->getAuthorType(),
				'text'       => $entity->getText(),
				'format'     => $entity->getFormat(),
				'url'        => $entity->getURLPath(),
			);
		}
		
		else
		{
			return array();
		}
	}
	
	/**
	 * @param Entity $entity
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeInspection(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return $this->item($entity->getInspection(), new InspectionTransformer());
		}
		
		else
		{
			return NULL;
		}
	}
	
	/**
	 * @param Entity $entity
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeMajorAssembly(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return $this->item($entity->getMajorAssembly(), new InspectionMajorAssemblyTransformer());
		}
		
		else
		{
			return NULL;
		}
	}
	
	/**
	 * @param Entity $entity
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeSubAssembly(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return $this->item($entity->getSubAssembly(), new InspectionSubAssemblyTransformer());
		}
		
		else
		{
			return NULL;
		}
	}
	
	/**
	 * @param Entity $entity
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeTechnician(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return $this->item($entity->getTechnician(), new TechnicianTransformer());
		}
		
		else
		{
			return NULL;
		}
	}
	
	/**
	 * @param Entity $entity
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeDomainExpert(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return $this->item($entity->getDomainExpert(), new DomainExpertTransformer());
		}
		
		else
		{
			return NULL;
		}
	}
	
	/**
	 * @param Entity $entity
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeAuthor(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			switch($entity->getAuthorType())
			{
				case (User::TYPE_TECHNICIAN):
				{
					return $this->includeTechnician($entity);
					
					break;
				}
				
				case (User::TYPE_DOMAIN_EXPERT):
				{
					return $this->includeDomainExpert($entity);
					
					break;
				}
				
				default:
				{
					return NULL;
				}
			}
		}
		
		else
		{
			return NULL;
		}
	}
	
	/**
	 * @param Entity $entity
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeRaw(Entity $entity)
	{
		if($this->verifyItem($entity) == TRUE)
		{
			return $this->item(
				$entity->getFilePath(),
				function ($item)
				{
					return array(
						'data' => base64_encode(file_get_contents($item)),
					);
				}
			);
		}
		
		else
		{
			return NULL;
		}
	}
}