<?php
include "dbconn.inc.php";

//the number of records displayed
$olddiplayedrecords =(int)$_GET['displayed'];

//the index of the last record displayed
// $lastrecordpointer = (int)$_GET['pointer'];
//get all records

$resultt = mysql_query("SELECT * FROM livestream");

$allrecords = mysql_num_rows($resultt);


//get the untouched records
$untouchedrecords = $allrecords - $olddiplayedrecords;

//check if the number of records in database equals the records displayed

if ($allrecords == $olddiplayedrecords) {
	exit();
} 
else if ($olddiplayedrecords <= $allrecords) {
	//limit should be less than pointer.
	$limit = getLimit($olddiplayedrecords);
	
	$query1 = "SELECT * FROM livestream WHERE id>='".$limit."' ORDER BY id DESC";
	
	$result1 = mysql_query($query1) or die(mysql_error());
	
	$count = mysql_num_rows($result1);
	
	mysql_data_seek($result1,$olddiplayedrecords);
	
	$r_data = '';
	
	$newrecordpointer='';
	while ($row = mysql_fetch_array($result1)) {
		 $timeframe = dateDiff(time(), (int)$row[2], 1);
		 $r_data .= $row[1] . "&nbsp;" . $timeframe . "&nbsp;" . $row[3] . "&nbsp;" . $row[4] . "&nbsp;" . $row[5];
	}
	$newdisplayedrecords = $olddiplayedrecords + 3;
	$data = $r_data . "." . $newdisplayedrecords;
	echo $data;
 }

function getLimit($np) {
	//set the records displayed to 5
	$queryit="SELECT * FROM livestream ORDER BY id DESC";
	$resultq=mysql_query($queryit);
	mysql_data_seek($resultq, $np);
	$row=mysql_fetch_row($resultq);
	$id=$row[0];//121
	$limit = $id-3;
	return $limit;
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