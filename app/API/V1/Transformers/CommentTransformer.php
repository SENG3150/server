<?php

namespace App\API\V1\Transformers;

use App\Entities\User;
use League\Fractal\TransformerAbstract;

use App\API\V1\Entities\Comment;

class CommentTransformer extends TransformerAbstract
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
	 * @param Comment $comment
	 *
	 * @return array
	 */
	public function transform(Comment $comment)
	{
		return array(
			'id'            => $comment->getId(),
			'timeCommented' => $comment->getTimeCommented(),
			'authorType'    => $comment->getAuthorType(),
			'text'          => $comment->getText(),
		);
	}

	/**
	 * @param Comment $comment
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeInspection(Comment $comment)
	{
		return $this->item($comment->getInspection(), new InspectionTransformer());
	}

	/**
	 * @param Comment $comment
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeMajorAssembly(Comment $comment)
	{
		return $this->item($comment->getMajorAssembly(), new InspectionMajorAssemblyTransformer());
	}

	/**
	 * @param Comment $comment
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeSubAssembly(Comment $comment)
	{
		return $this->item($comment->getSubAssembly(), new InspectionSubAssemblyTransformer());
	}

	/**
	 * @param Comment $comment
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeTechnician(Comment $comment)
	{
		return $this->item($comment->getTechnician(), new TechnicianTransformer());
	}

	/**
	 * @param Comment $comment
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeDomainExpert(Comment $comment)
	{
		return $this->item($comment->getDomainExpert(), new DomainExpertTransformer());
	}

	/**
	 * @param Comment $comment
	 *
	 * @return \League\Fractal\Resource\Item
	 */
	public function includeAuthor(Comment $comment)
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