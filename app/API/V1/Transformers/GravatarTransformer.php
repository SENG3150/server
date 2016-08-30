<?php

namespace App\API\V1\Transformers;

use App\Transformers\Transformer;

class GravatarTransformer extends Transformer
{
	/**
	 * @param string $emailHash
	 *
	 * @return array
	 */
	public function transform($emailHash)
	{
		return array(
			'raw' => base64_encode(file_get_contents('https://www.gravatar.com/avatar/' . $emailHash . '?d=mm&s=42')),
		);
	}
}