<?php

namespace App\API\V1\Transformers;

use App\Entities\User;
use League\Fractal\TransformerAbstract;

use App\API\V1\Entities\InspectionComment;

class InspectionCommentTransformer extends TransformerAbstract
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
	 * @param InspectionComment $comment
	 *
	 * @return array
	 */
	public function transform(InspectionComment $comment)
	{
		return array(
			'id'            => $comment->getId(),
			'timeCommented' => $comment->getTimeCommented(),
			'authorType'    => $comment->getAuthorType(),
			'text'          => $comment->getText(),
		);
	}

	/**
	 * @param InspectionComment $comment
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeInspection(InspectionComment $comment)
	{
		return $this->item($comment->getInspection(), new InspectionTransformer());
	}

	/**
	 * @param InspectionComment $comment
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeMajorAssembly(InspectionComment $comment)
	{
		return $this->item($comment->getMajorAssembly(), new InspectionMajorAssemblyTransformer());
	}

	/**
	 * @param InspectionComment $comment
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeSubAssembly(InspectionComment $comment)
	{
		return $this->item($comment->getSubAssembly(), new InspectionSubAssemblyTransformer());
	}

	/**
	 * @param InspectionComment $comment
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeTechnician(InspectionComment $comment)
	{
		return $this->item($comment->getTechnician(), new TechnicianTransformer());
	}

	/**
	 * @param InspectionComment $comment
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeDomainExpert(InspectionComment $comment)
	{
		return $this->item($comment->getDomainExpert(), new DomainExpertTransformer());
	}

	/**
	 * @param InspectionComment $comment
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeAuthor(InspectionComment $comment)
	{
		switch($comment->getAuthorType())
		{
			case (User::TYPE_TECHNICIAN):
			{
				return $this->includeTechnician($comment);

				break;
			}

			case (User::TYPE_DOMAIN_EXPERT):
			{
				return $this->includeDomainExpert($comment);

				break;
			}

			default:
			{
				return NULL;
			}
		}
	}
}