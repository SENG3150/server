<?php

if(function_exists('entity_dump') == FALSE)
{
	/**
	 * @param object $object
	 * @param int    $maxDepth
	 * @param bool   $stripTags
	 * @param bool   $echo
	 */
	function entity_dump($object, $maxDepth = 2, $stripTags = TRUE, $echo = TRUE)
	{
		echo '<pre>';
		\Doctrine\Common\Util\Debug::dump($object, $maxDepth, $stripTags, $echo);
		echo '</pre>';
	}
}