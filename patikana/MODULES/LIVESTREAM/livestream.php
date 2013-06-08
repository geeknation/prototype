<?php
/*
 Livestream.php: fetches user activity on the platform and display it in real time
 */
session_start();
include "dbconn.inc.php";
global $prev_pointer;
//check if it is an ajax request
if ($_SERVER['HTTP_X_REQUESTED_WITH'] and strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

	if (isset($_GET['flag']) and $_GET['flag'] == 'check') {
		//check for new records
		$resp=detectNewRecords($_GET['oldrecords']);
		echo $resp;
	} 
	else {
		//fetch the new records from the database and return them back to the user
		$lastcount = $_POST['last_count'];
		//last number of recordset
		$query = "SELECT * FROM livestream order by id DESC";
		//query the database
		$result = mysql_query($query);
		$latestcount = mysql_num_rows($result);
		//count the current records
		if ($latestcount == $lastcount) {
			exit();
		}
		if ($latestcount > $lastcount) {//check if the latest records are greater than the previous records
			$latestpointer = 0;
			//move the pointer to the next new record
			$lastcount = $latestcount;
			//update the number of recordset
			$result = mysql_query($query);
			//query for the new records
			mysql_data_seek($result, $latestpointer);
			//move the pointer to the latest row
			$row = mysql_fetch_row($result);
			//get the latest row values
			$t=(int)$row[2];
			$timeframe=dateDiff(time(), $t, 1);
			$r_data = $row[1] . "&nbsp;" . $timeframe . "&nbsp;" . $row[3] . "&nbsp;" . $row[4]."&nbsp;".$row[5];
			$data = $r_data . "." . $lastcount;
			//append all the data
			echo $data;
			//return all the data
		}
	}

}

function detectNewRecords($old) {
	$query="SELECT * FROM livestream";
	$count=mysql_num_rows(mysql_query($query));
	if($count>(int)$old){
		return "new records";
	}else{
		return "no new";
	}
}

function dateDiff($time1, $time2, $precision = 1) {

	// If not numeric then convert texts to unix timestamps
	if (!is_int($time1)) {
		$time1 = strtotime($time1);
	}
	if (!is_int($time2)) {
		$time2 = strtotime($time2);
	}

	// If time1 is bigger than time2
	// Then swap time1 and time2
	if ($time1 > $time2) {
		$ttime = $time1;
		$time1 = $time2;
		$time2 = $ttime;
	}

	// Set up intervals and diffs arrays
	$intervals = array('year', 'month', 'day', 'hour', 'minute', 'second');
	$diffs = array();

	// Loop thru all intervals
	foreach ($intervals as $interval) {
		// Set default diff to 0
		$diffs[$interval] = 0;
		// Create temp time from time1 and interval
		$ttime = strtotime("+1 " . $interval, $time1);
		// Loop until temp time is smaller than time2
		while ($time2 >= $ttime) {
			$time1 = $ttime;
			$diffs[$interval]++;
			// Create new temp time from time1 and interval
			$ttime = strtotime("+1 " . $interval, $time1);
		}
	}

	$count = 0;
	$times = array();
	// Loop thru all diffs
	foreach ($diffs as $interval => $value) {
		// Break if we have needed precission
		if ($count >= $precision) {
			break;
		}
		// Add value and interval
		// if value is bigger than 0
		if ($value > 0) {
			// Add s if value is not 1
			if ($value != 1) {
				$interval .= "s";
			}
			// Add value and interval to times array
			$times[] = $value . " " . $interval;
			$count++;
		}
	}

	// Return string with times
	return implode(", ", $times);
}
?>
