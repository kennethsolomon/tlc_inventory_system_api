<?php

namespace App\Services;

use Carbon\Carbon;
use DateInterval;
use DateTime;

class MaintenanceService
{
	private static $instance = null;

	public static function getInstance()
	{
		if (self::$instance == null) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function getFrequencyDate($start_date, $frequency)
	{
		$date = new DateTime($start_date);

		switch ($frequency) {
			case 'Weekly':
				$interval = new DateInterval('P1W');
				break;

			case 'Monthly':
				$interval = new DateInterval('P1M');
				break;

			case 'Quarterly':
				$interval = new DateInterval('P3M');
				break;

			case 'Yearly':
				$interval = new DateInterval('P1Y');
				break;

			case 'Biennial':
				$interval = new DateInterval('P2Y');
				break;
		}

		$newDate = clone $date;
		$newDate->add($interval);

		return $newDate->format('Y-m-d');
	}

	public function canRun($date, $subday)
	{
		return Carbon::parse($date)->subDays($subday)->isToday();
	}
}
