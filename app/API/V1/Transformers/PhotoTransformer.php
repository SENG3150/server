<?php

namespace App\API\V1\Transformers;

use App\Entities\User;

use App\API\V1\Entities\Photo;

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
	);
	
	/**
	 * @var array
	 */
	protected $defaultIncludes = array(
		'author',
	);
	
	/**
	 * @param Photo $photo
	 *
	 * @return array
	 */
	public function transform(Photo $photo)
	{
		return array(
			'id'         => $photo->getId(),
			'authorType' => $photo->getAuthorType(),
			'text'       => $photo->getText(),
			'format'     => $photo->getFormat(),
			'url'        => $photo->getURLPath(),
		);
	}
	
	/**
	 * @param Photo $photo
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeInspection(Photo $photo)
	{
		return $this->item($photo->getInspection(), new InspectionTransformer());
	}
	
	/**
	 * @param Photo $photo
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeMajorAssembly(Photo $photo)
	{
		return $this->item($photo->getMajorAssembly(), new InspectionMajorAssemblyTransformer());
	}
	
	/**
	 * @param Photo $photo
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeSubAssembly(Photo $photo)
	{
		return $this->item($photo->getSubAssembly(), new InspectionSubAssemblyTransformer());
	}
	
	/**
	 * @param Photo $photo
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeTechnician(Photo $photo)
	{
		return $this->item($photo->getTechnician(), new TechnicianTransformer());
	}
	
	/**
	 * @param Photo $photo
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeDomainExpert(Photo $photo)
	{
		return $this->item($photo->getDomainExpert(), new DomainExpertTransformer());
	}
	
	/**
	 * @param Photo $photo
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeAuthor(Photo $photo)
	{
		switch($photo->getAuthorType())
		{
			case (User::TYPE_TECHNICIAN):
			{
				return $this->includeTechnician($photo);
				
				break;
			}
			
			case (User::TYPE_DOMAIN_EXPERT):
			{
				return $this->includeDomainExpert($photo);
				
				break;
			}
			
			default:
			{
				return NULL;
			}
		}
	}
	
	/**
	 * @param Photo $photo
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeRaw(Photo $photo)
	{
		return $this->item(
			$photo->getFilePath(),
			function ($item)
			{
				return array(
					'data' => base64_encode(file_get_contents($item)),
				);
			}
		);
	}
}