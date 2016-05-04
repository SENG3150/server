<?php

namespace App\API\V1\Controllers;

use App\Transformers\UserTransformer;

class UserController extends APIController
{
	public function me()
	{
		return $this->response->item($this->getAuthenticatedUser(), new UserTransformer());
	}
}