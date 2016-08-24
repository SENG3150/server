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
	 * @param array $input
	 * @param array $repositories
	 * @param       $type
	 *
	 * @return null
	 * @throws \Dingo\Api\Exception\ValidationHttpException
	 */
	protected function resolveOne(array $input, array $repositories, &$type)
	{
		foreach($repositories as $key => $repository)
		{
			if(array_key_exists($key, $input) == TRUE && $input[$key] != NULL)
			{
				$entity = App::make($repository)->find($input[$key]);

				if($entity != NULL)
				{
					$type = $key;

					return $entity;
				}

				else
				{
					throw new \Dingo\Api\Exception\ValidationHttpException(
						array(
							$key => 'This ' . $key . ' does not exist.'
						)
					);
				}
			}
		}

		return NULL;
	}

	protected function resolve(&$entity, array $input, $key, $type = 'string', $repository = NULL)
	{
		if(array_key_exists($key, $input) == TRUE)
		{
			$function = 'set' . ucfirst($key);
			$value    = NULL;

			switch($type)
			{
				case 'string':
				{
					$value = $input[$key];

					break;
				}

				case 'int':
				case 'integer':
				{
					$value = intval($input[$key]);

					break;
				}

				case 'double':
				case 'float':
				{
					$value = floatval($input[$key]);

					break;
				}

				case 'datetime':
				{
					$this->validateArray(
						$input,
						array(
							$key => 'isodatetime'
						)
					);

					$value = new \DateTime($input[$key]);

					break;
				}

				case 'bool':
				{
					$value = boolval($input[$key]);

					break;
				}

				case 'entity':
				{
					if($value instanceof App\Entities\Entity == FALSE)
					{
						if(isset($value->id) == TRUE)
						{
							$value = App::make($repository)->find($value->id);
							
							if($value == NULL)
							{
								throw new \Dingo\Api\Exception\ValidationHttpException(
									array(
										$key => 'This ' . $key . ' does not exist.'
									)
								);
							}
						}
						
						else if(array_key_exists('id', $value) == TRUE)
						{
							$value = App::make($repository)->find($value['id']);
							
							if($value == NULL)
							{
								throw new \Dingo\Api\Exception\ValidationHttpException(
									array(
										$key => 'This ' . $key . ' does not exist.'
									)
								);
							}
						}
						
						else
						{
							throw new \Dingo\Api\Exception\ValidationHttpException(
								array(
									$key => 'Must be an instance of Entity or have an "id" property.'
								)
							);
						}
					}

					break;
				}

				case 'array':
				{
					$value = $input[$key];

					break;
				}

				default:
				{
					throw new \InvalidArgumentException('Type ' . $type . ' not found.');
				}
			}

			$entity->$function($value);
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
	 *
	 * @return object
	 */
	public function create($input, $recursive = TRUE)
	{
		return NULL;
	}

	/**
	 * @param Request|array $input
	 * @param int           $id
	 * @param bool          $recursive
	 *
	 * @return object
	 */
	public function update($input, $id, $recursive = TRUE)
	{
		return NULL;
	}

	/**
	 * @param Request|array $input
	 * @param int           $id
	 * @param bool          $recursive
	 *
	 * @return object
	 */
	public function handle($input, $id = NULL, $recursive = TRUE)
	{
		if($id == NULL)
		{
			if(array_key_exists('id', $input) == TRUE)
			{
				return $this->update($input, $input['id'], $recursive);
			}

			else
			{
				return $this->create($input, $recursive);
			}
		}

		else
		{
			return $this->update($input, $id, $recursive);
		}
	}
}