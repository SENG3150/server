<?php

namespace App\API\V1\Parsers;

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory;
use App;

class Parser
{
	/** @var EntityManagerInterface $em */
	var $em;

	/** @var Factory $validationFactory */
	var $validationFactory;

	public function __construct()
	{
		$this->em                = App::make(EntityManagerInterface::class);
		$this->validationFactory = App::make(Factory::class);
	}

	/**
	 * @param $input
	 *
	 * @return array
	 */
	protected function resolveInput($input)
	{
		if($input instanceof Request)
		{
			return $input->input();
		}

		else
		{
			return $input;
		}
	}

	/**
	 * @param array $array
	 * @param array $rules
	 * @param array $messages
	 * @param array $customAttributes
	 *
	 * @throws \Dingo\Api\Exception\ValidationHttpException
	 */
	protected function validateArray(array $array, array $rules, array $messages = [], array $customAttributes = [])
	{
		$validator = $this->validationFactory->make($array, $rules, $messages, $customAttributes);

		if($validator->fails())
		{
			throw new \Dingo\Api\Exception\ValidationHttpException($validator->errors());
		}
	}

	/**
	 * @param Request|array $input
	 * @param bool          $recursive
	 */
	public function create($input, $recursive = TRUE)
	{

	}

	/**
	 * @param Request|array $input
	 * @param int           $id
	 * @param bool          $recursive
	 */
	public function update($input, $id, $recursive = TRUE)
	{

	}

	/**
	 * @param Request|array $input
	 * @param int           $id
	 * @param bool          $recursive
	 */
	public function handle($input, $id = NULL, $recursive = TRUE)
	{
		if($id == NULL)
		{
			if(array_key_exists('id', $input) == TRUE)
			{
				$this->update($input, $input['id'], $recursive);
			}

			else
			{
				$this->create($input, $recursive);
			}
		}

		else
		{
			$this->update($input, $id, $recursive);
		}
	}
}