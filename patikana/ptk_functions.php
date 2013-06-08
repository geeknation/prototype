<?php
/*
 * GENERIC FUNCTIONS TO BE USED ACROSS THE APPLICATION
 * ENTEL LIMITED 2011
 * ALL RIGHTS RESERVED
 *
 * */
function ptk_uniq_id() {
	$random = rand(100, 1000000);
	return uniqid($random);
}function ptk_local_time() {
	$unixtime = time();
	$offset = 5 * 60 * 60;
	$unixtime += $offset;
	$humantime = gmdate('g:i:s', $unixtime);
	$date = date('d-m-Y');
	$timestamp = $humantime . "&nbsp;" . $date;
	return $timestamp;
}/**
 * THIS FUNCTION HIDES PART OF THE NAMES USING ASTERIX
 */
function name_shuffle($string) {
	//seperate the characters of the string
	$chunked = chunk_split($string, 1, ".");
	//put the seperateed characters into an array
	$exploded = explode(".", $chunked);
	//get the length of the array elements
	$length = count($exploded);
	//create a complete star array
	for ($ic = 0; $ic < $length; $ic++) {
		$stararray[$ic] = "*";
	}
	//assigning the values into a new string
	//CONVERTING IT TO A STRING array AS A STRING
	for ($i = 0; $i <= $length; $i++) {
		//GETTING AN INDIVIDUAL ARRAY ELEMENT AND ASSIGNING IT TO A VARIABLE
		$value = $exploded[$i];
		//CONVERTING IT TO A STRING
		$value = (string)$value;
		//PUTTING THE CONVERTED ELEMENT INTO ARRAY OF TYPE STRING
		$stringarray[$i] = $value;
	}
	//GETTING THE LENGTH OF THE NEW ARRAY ELEMENT
	$newarraylength = count($stringarray);
	//inserting the string array into the complete star array
	$encrypteddata;
	$e = 0;
	while ($e < $newarraylength) {
		$stararray[$e] = $stringarray[$e];
		$encrypteddata = join(" ", $stararray);
		$e = $e + 2;
	}
	return $encrypteddata;
}function get_finder_details($user) {
	include 'dbconn.inc.php';
	$query = "SELECT login.username,user_phoneno.phone_number FROM login INNER JOIN user_phoneno ON login.user_id=user_phoneno.user_id WHERE login.username='" . $user . "'";
	$result = mysql_query($query);
	echo "you are the finder of the item the following details about you as the finder will be provided:<p/>";
	echo "<table  align='center' width='300'>";
	$content = '';
	$row = mysql_fetch_array($result);
	$username = $row['username'];
	$phonenumber = $row['phone_number'];
	echo  "
		 <tr>
		 <td>Found by:</td>
		 <td><b>$username<b/></td>
		 </tr>
		 <tr>
		 <td>Phone number</td>
		 <td><b>$phonenumber<b/></td>
		 </tr></table>";
}function get_user_id($user) {
	include "dbconn.inc.php";
	$query = "SELECT user_id FROM login WHERE username='" . $user . "'";
	$result = mysql_query($query)or die(mysql_error());
	$uid = '';
	while ($row = mysql_fetch_array($result)) {
		$uid = $row['user_id'];
	}
	return $uid;
}function get_user_names($user) {
	include "dbconn.inc.php";
	$query = "SELECT names FROM users WHERE user_id='" . $user . "'";
	$result = mysql_query($query);
	$usernames = '';
	while ($row = mysql_fetch_array($result)) {
		$usernames = $row['names'];
	}
	return $usernames;
}function get_user_email($user) {
	include "dbconn.inc.php";
	$query = "SELECT emailadress FROM user_email WHERE user_id='" . $user . "'";
	$result = mysql_query($query);
	$useremail = '';
	while ($row = mysql_fetch_array($result)) {
		$email = $row['emailadress'];
	}
	return $email;
}function get_user_number($user) {
	include "dbconn.inc.php";
	$query = "SELECT phone_number FROM user_phoneno WHERE user_id='" . $user . "'";
	$result = mysql_query($query);
	$number = '';
	while ($row = mysql_fetch_array($result)) {
		$number = $row['phone_number'];
	}
	return $number;
}function get_user_location($user) {
	include "dbconn.inc.php";
	$query = "SELECT location FROM users WHERE user_id='" . $user . "'";
	$result = mysql_query($query);
	$location = '';
	while ($row = mysql_fetch_array($result)) {
		$location = $row['location'];
	}
	return $location;
}function get_user_age($user) {
	include "dbconn.inc.php";
	$query = "SELECT age FROM users WHERE user_id='" . $user . "'";
	$result = mysql_query($query);
	$age = '';
	while ($row = mysql_fetch_array($result)) {
		$age = $row['age'];
	}
	return $age;
}function get_user_gender($user) {
	include "dbconn.inc.php";
	$query = "SELECT gender FROM users WHERE user_id='" . $user . "'";
	$result = mysql_query($query);
	$gender = '';
	while ($row = mysql_fetch_array($result)) {
		$gender = $row['gender'];
	}
	return $gender;
}function ptk_convert_time_to_timestamp($time) {
	$exploded = explode("-", $time);
	$month = $exploded[0];
	$day = $exploded[1];
	$year = $exploded[2];
	$finaltime = mktime(0, 0, 0, $month, $day, $year);
	return $finaltimestamp;
}function updateItemAvailability($query) {
	$result = mysql_query($query);
	if ($result) {
		echo "ok";
	} else {
		echo "failed";
	}
}function ptk_visitor_counter() {	$location = 'kenya';	include 'dbconn.inc.php';		$ip = getIpAddress();	$check = mysql_query("SELECT ipadress FROM sitecounter WHERE ip='" . $ip . "';");	$times = 1;	if (mysql_num_rows($check) == 0) {		$result = mysql_query("INSERT INTO sitecounter(ipadress,location) VALUES ('" . $ip . "','" . $location . "') ;") or die(mysql_error());	}}function getIpAddress() {	$ip = '';	if (!empty($_SERVER['REMOTE_ADDR'])) {		$ip = @$_SERVER['REMOTE_ADDR'];	}	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {		$ip = @$_SERVER['HTTP_CLIENT_IP'];	}	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))	//to check ip is pass from proxy	{		$ip = @$_SERVER['HTTP_X_FORWARDED_FOR'];	}	return $ip;}function checkUserAgent() {	if (stripos(strtolower($_SERVER["HTTP_USER_AGENT"]), 'opera') || stripos(strtolower($_SERVER["HTTP_USER_AGENT"]), 'android') || stripos(strtolower($_SERVER["HTTP_USER_AGENT"]), 'iphone') || stripos(strtolower($_SERVER["HTTP_USER_AGENT"]), 'blackberry') || stripos(strtolower($_SERVER['HTTP_USER_AGENT']), 'ipod') || stripos(strtolower($_SERVER['HTTP_USER_AGENT']), 'nokia')) {		header("Location: http://m.patikana.co.ke");	} else if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "wap") || strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "wml")) {		header("Location: http://m.patikana.co.ke/wml/");	} else {		header("Location: https://www.patikana.co.ke/Home.php");	}}?>