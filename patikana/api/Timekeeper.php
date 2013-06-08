<?php
/*
 *
 * THIS IS THE Timekeeper class, THIS CLASS PERFORM TIME GENERAL TIME FUNCTIONS AND TIMESTAMP
 * CONVERSIONS THROUGHOUT THE DOCUMENT.
 * COPY 2012
 */
class Timekeeper {
	function ptk_local_time() {
		$unixtime = time();
		$offset = 5 * 60 * 60;
		$unixtime += $offset;
		$humantime = gmdate('g:i:s', $unixtime);
		$date = date('d-m-Y');
		$timestamp = $humantime . "&nbsp;" . $date;
		return $timestamp;
	}	function ptk_convert_time_to_timestamp($time) {
		$exploded = explode("-", $time);
		$month = $exploded[0];
		$day = $exploded[1];
		$year = $exploded[2];
		$finaltime = mktime(0, 0, 0, $month, $day, $year);
		return $finaltimestamp;
	}}?>