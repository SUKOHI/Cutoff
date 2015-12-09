<?php namespace Sukohi\Cutoff;

use Carbon\Carbon;

class Cutoff {

	public function nextDate($base_dt, $cutoff_day) {

		return $this->date($base_dt, $cutoff_day, 'next');

	}

	public function prevDate($base_dt, $cutoff_day) {

		return $this->date($base_dt, $cutoff_day, 'prev');

	}

	public function range($year, $month, $day) {

		$base_dt = Carbon::create($year, $month, 1, 0, 0, 0);
		$start_dt = Carbon::create($year, $month, $day, 0, 0, 0)
						->subMonth()
						->addDay();

		if($start_dt->month == $month) {

			$start_dt = $base_dt->copy();

		}

		$last_day = $base_dt->format('t');

		if($day > $last_day) {

			$day = $last_day;

		}

		return [
			'start' => $start_dt,
			'end' => Carbon::create($year, $month, $day, 23, 59, 59)
		];

	}

	private function date($base_dt, $cutoff_day, $mode) {

		$year = $base_dt->year;
		$month = $base_dt->month;
		$day = $base_dt->day;
		$lat_day = $base_dt->format('t');
		$cutoff_day = min($lat_day, $cutoff_day);

		if($this->is_next($day, $cutoff_day, $mode) ||
			$this->is_prev($day, $cutoff_day, $mode)) {

			$base_dt = Carbon::createFromDate($year, $month, 1);

			if($this->is_next($day, $cutoff_day, $mode)) {

				$base_dt->addMonth();

			} else {

				$base_dt->subMonth();

			}

			$last_day = $base_dt->format('t');
			$cutoff_day = min($last_day, $cutoff_day);
			$year = $base_dt->year;
			$month = $base_dt->month;

		}

		return Carbon::create($year, $month, $cutoff_day, 1, 1, 1);

	}

	private function is_next($day, $cutoff_day, $mode) {

		return ($mode == 'next' && $day > $cutoff_day);

	}

	private function is_prev($day, $cutoff_day, $mode) {

		return ($mode == 'prev' && $day < $cutoff_day);

	}

}