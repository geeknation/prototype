<?php

include 'ptk_functions.php';
require_once 'dbconn.inc.php';

$type = str_replace(array(',', '"', '?', "\'", '`', '(', ')', '>', '<', '!', ';', '|', '&', '%', '*', '^', '~'), '', mysql_real_escape_string(htmlspecialchars(htmlentities(stripslashes(trim($_POST['itemtype']))))));
$other = str_replace(array(',', '"', '?', "\'", '`', '(', ')', '>', '<', '!', ';', '|', '&', '%', '*', '^', '~'), '', mysql_real_escape_string(htmlspecialchars(htmlentities(stripslashes(trim($_POST['other']))))));
$names = str_replace(array(',', '"', '?', "\'", '`', '(', ')', '>', '<', '!', ';', '|', '&', '%', '*', '^', '~'), '', mysql_real_escape_string(htmlspecialchars(htmlentities(stripslashes(trim($_POST['names']))))));
$serial = str_replace(array(',', '"', '?', "\'", '`', '(', ')', '>', '<', '!', ';', '|', '&', '%', '*', '^', '~'), '', mysql_real_escape_string(htmlspecialchars(htmlentities(stripslashes(trim($_POST['itemnumber']))))));
$phoneno = str_replace(array(',', '"', '?', "\'", '`', '(', ')', '>', '<', '!', ';', '|', '&', '%', '*', '^', '~'), '', mysql_real_escape_string(htmlspecialchars(htmlentities(stripslashes(trim($_POST['phonenumber']))))));
$emailadd = str_replace(array(',', '"', '?', "\'", '`', '(', ')', '>', '<', '!', ';', '|', '&', '%', '*', '^', '~'), '', mysql_real_escape_string(htmlspecialchars(htmlentities(stripslashes(trim($_POST['email']))))));
// $school=str_replace(array(',', '"', '?', "\'", '`', '(', ')', '>', '<', '!', ';', '|', '&', '%', '*', '^', '~'), '', mysql_real_escape_string(htmlspecialchars(htmlentities(stripslashes(trim($_POST['school']))))));
$time = time();

$announceditemid = ptk_uniq_id();

if (check_existence($serial)) {
	echo "document already announced lost";
	exit();
} else {

	//list($announcer) = explode(" ", $names);
	//Extract first name of the announcer
	if (empty($other)) {
		$proprietor=0;
		$time=time();
		$query = "insert into announcedlost(itemnumber,itemtype,proprietor,names,phoneno,emailadd,timeannounced) values('$serial','$type','$proprietor','$names','$phoneno','$emailadd','$time ');";
		$result = mysql_query($query) or die(mysql_error());
		if ($result) {
			echo "item announced";
		} else {
			echo "not announced";
		}
	} else {
		//Add other to item
		$time=time();
		$query = "insert into announcedlost(itemnumber,itemtype,proprietor,names,phoneno,emailadd,timeannounced) values('$serial','$type','$other','$names','$phoneno','$emailadd','$time');";
		$result = mysql_query($query)or die(mysql_error());
		if ($result) {
			echo "item announced";
		} else {
			echo "not announced";
		}
	}
}

function check_existence($number) {
	$query = "SELECT itemnumber FROM announcedlost WHERE itemnumber='" . $number . "' AND locked=0";
	$result = mysql_query($query) or die(mysql_error());
	$exist = mysql_num_rows($result);

	if ($exist == 1) {
		return true;
	} else {
		return false;
	}
}

/*
 function get_set_item($a,$b,$c,$d){

 if(isset($a)){
 return $a;
 }
 else if(isset($b)){
 return $b;
 }else if(isset($c)){
 return $c;
 }
 else if(isset($d)){
 return $d;
 }
 return true;
 }*/

//get human readable location
//$location=$this->getGeoLocation($_SERVER['REMOTE_ADDR']);
?>