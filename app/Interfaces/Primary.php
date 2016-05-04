<?php

namespace App\Interfaces;

interface Primary
{
	/**
	 * @return int
	 */
	public function getId();

	/**
	 * @return string
	 */
	public function getName();

	/**
	 * @return string
	 */
	public function getPassword();

	/**
	 * @return string
	 */
	public function getEmail();

	/**
	 * @param string $password
	 *
	 * @return boolean
	 */
	public function matchesPassword($password);
}