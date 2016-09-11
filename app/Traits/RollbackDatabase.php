<?php

namespace App\Traits;

use Doctrine\ORM\EntityManagerInterface;

trait RollbackDatabase
{
	/**
	 * Handle database transactions on the specified connections.
	 *
	 * @return void
	 */
	public function rollback()
	{
		/** @var EntityManagerInterface $em */
		$em = app('em');
		
		$em->beginTransaction();
		
		$this->beforeApplicationDestroyed(function () use ($em) {
			$em->rollback();
		});
	}
}