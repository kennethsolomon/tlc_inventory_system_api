<?php

namespace App\Services;

use App\Models\Maintenance;
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

	public function plotMaintenance($maintenance)
	{
		$schedule_date = Carbon::parse($maintenance->schedule_date);
		while (2024 >= $schedule_date->format('Y')) {
			info('Creating new Maintenance');

			$start_date = $this->getFrequencyDate($schedule_date, $maintenance->frequency);

			$new_maintenance = $maintenance->replicate();

			$new_maintenance->start_date = $start_date;
			$new_maintenance->is_approved = true;
			$new_maintenance->end_date = $start_date;
			$new_maintenance->save();

			$maintenance->is_approved = false;
			$maintenance->save();

			$schedule_date = Carbon::parse($start_date);
		}
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

			case 'No Repeat':
				$interval = new DateInterval('P0D');
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
