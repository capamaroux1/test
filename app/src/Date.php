<?php

namespace app\src;

class Date
{
	/**
	 * Find the difference in days between two dates.
	 *
	 * @param string $fromDate 
	 * @param string $toDate
	 * @return string
	 */	
	public static function diff($fromDate, $toDate)
	{
		$origin = new \DateTime($fromDate);
		$target = new \DateTime($toDate);
		$interval = $origin->diff($target);

		return $interval->format('%a day(s)');
	}
}
