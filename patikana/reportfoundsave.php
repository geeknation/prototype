<?php

/* This class handles requests for general use in the application
 * Copyright patikana 2012
 */
session_start();
$user = $_SESSION['user_allow'];
require_once 'dbconn.inc.php';
//Request database connection
require_once "api/User.php";
require_once ("api/Search.php");
//require_once ("ip2locationlite.class.php");
require_once ("AfricasTalkingGateway.php");
require_once ("ptk_functions.php");
//Request id determines function to execute from ajax call
$s = new Search();
$type = mysql_real_escape_string(trim($_POST['type']));
$names = mysql_real_escape_string(trim($_POST['names']));
$itemnumber = mysql_real_escape_string(trim($_POST['itemnumber']));
$locationfound = mysql_real_escape_string(trim($_POST['locationfound']));
$other = mysql_real_escape_string(trim($_POST['other']));
$reported = isReported($itemnumber, $names, $type);

if ($reported) {
	echo "<div class='alert alert-warning'>Document has already been saved</div>";
	exit();
}
//save document if not reported already
else {

	if ($other == "") {
		//SAVE NATIONAL ID DATA
		$u = new User();
		$findersid = get_user_id($user);
		$timereported = time();
		$proprietor = "GOK";
		$address = " 192.168.0.19";
		// $geolocation = getGeoLocation($address);
		// $city = $geolocation['city'];
		// $region = $geolocation['region'];
		// $country = $geolocation['country'];
		// $geoloc = $city . "," . $region . "," . $country;
		$geoloc = "South C";
		$query_0 = "insert into reported(id,number,names,type,proprietor,timereported,locationfound,geolocation) values('" . $findersid . "','" . $itemnumber . "','" . $names . "','" . $type . "','" . $proprietor . "','" . $timereported . "','" . $locationfound . "','" . $geoloc . "');";
		$result = mysql_query($query_0) or die(mysql_error());
		if ($result) {
			if (isAnnounced($itemnumber, $names, $type)) {
				//lock the announced document
				$queryupdate = "update announcedlost set locked='1' where itemnumber =	'" . $itemnumber . "' and names='" . $names . "' and itemtype='" . $type . "' and locked='0';";
				$resultupdate = mysql_query($queryupdate) or die(mysql_error());
				//SEND THE USER A TEXT MESSAGE TO ALERT THEM
				alertUser($itemnumber, $itype);
				echo "<div class='alert alert-success'>Document has been saved</div>";
			} else {
				echo "<div class='alert alert-success'>Document has been saved</div>";
			}

		} else {
			echo "<div class='alert alert-success'>Something bad has happened please try again later</div>";
		}

	} else {
		//SAVE OTHER ITEM
		$u = new User();
		$findersid = get_user_id($user);
		$address = " 192.168.0.19";
		$geolocation = getGeoLocation($address);
		$city = $geolocation['city'];
		$region = $geolocation['region'];
		$country = $geolocation['country'];
		$geoloc = $city . "," . $region . "," . $country;
		$query_1 = "insert into reported(id,number,names,type,proprietor,timereported,locationfound,geolocation) values('" . $findersid . "','" . $itemnumber . "','" . $names . "','" . $type . "','" . $other . "','" . $timereported . "','" . $locationfound . "','" . $geoloc . "');";
		$result = mysql_query($query_1) or die(mysql_error());
		if ($result) {
			if (isAnnounced($itemnumber, $names, $type)) {
				//lock the annouced item
				$queryupdate = "update announcedlost set locked='1' where itemnumber =	'" . $itemnumber . "' and names='" . $names . "' and itemtype='" . $type . "' and locked='0';";
				$resultupdate = mysql_query($queryupdate) or die(mysql_error());
				//SEND THE USER A TEXT MESSAGE TO ALERT THEM
				alertUser($itemnumber, $itype);
				echo "<div class='alert alert-success'>Document has been saved</div>";
			} else {
				echo "<div class='alert alert-success'>Document has been saved</div>";
			}

		} else {
			echo "<div class='alert alert-success'>Something bad has happened please try again later</div>";
		}

	}//End if--else for has other in data
}

/** Returns a topple name * */
function proprietor($type) {
	switch (strtolower($type)) {
		case "national id" :
			return "GOK";
		case "school id" :
			return "school_id";
		case "atm card" :
			return "atm_card";
		case "driving licence" :
			return "driving_licence";
		case "passport" :
			return "passport";
		case "some other" :
			return "itemname:other_item";
	}
}

//End function topple name

/** Help function * */
function help() {
	$help = str_replace(array(',', '"', '?', "\'", '`', '(', ')', '>', '<', '!', ';', '|', '&', '%', '*', '^', '~'), '', mysql_real_escape_string(htmlspecialchars(htmlentities(stripslashes(trim($_POST['help']))))));
	switch ($help) {
		case "itemnumber" :
			echo '<hr><span id="dialogtitle">About Item Numbers</span>
                    <span id="close" title="Close help box"><img src="icons/close.jpeg" width="14" height="14" alt="x"/></span><br>                    
                    <span>
                    <br>
                    <table>
                    <tr><td colspan="2">What Patikana uses to uniquely differentiate items</td></tr>
                    <tr><td>National ID</td><td>ID number</td></tr>
                    <tr><td>School ID</td><td>Registration/Admission number</td></tr>
                    <tr><td>Passport</td><td>Passport number</td></tr>
                    <tr><td>Driving licence</td><td>Driving licence number</td></tr>
                    <tr><td>Electronics</td><td>Serial/IME number</td></tr>
                    <table>
                    </span>';
			break;
	}
	//End switch
}

/** Function to check if the  item being reported is announced * */
function isAnnounced($itemnumber, $names, $type) {
	//Item is known
	$query = "select * from announcedlost where itemnumber ='" . $itemnumber . "' and names='" . $names . "' and itemtype='" . $type . "' and locked='0';";
	$result = mysql_query($query) or die(mysql_error());
	if (mysql_num_rows($result) == 1) {
		return true;
	} else {
		return false;
	}
}

//End function isAnnounced

function isReported($number, $names, $type) {
	$query = "select number,names from reported where claimed=0 and number = '" . $number . "' and type = '" . $type . "' AND names='" . $names . "';";
	$result = mysql_query($query);
	$count = mysql_num_rows($result);
	if ($count == 1) {
		return true;
	} else {
		return false;
	}
}

function alertUser($itemnumber, $itype) {
	$username = "patikana";
	$apiKey = "4cca280240e0aac18819ae9af038e2e8a88d383c29ec0e284e5200bdae1d5361";
	$gateway = new AfricaStalkingGateway($username, $apiKey);
	$query = "select * from announcedlost where itemnumber='" . $itemnumber . "' and itemtype='" . $itype . "' and locked=0;";
	$result = mysql_query($query) or die(mysql_error());
	$announcer = "";
	$recipients = '';
	$names = '';
	$type = '';
	$row = mysql_fetch_array($result);
	$recipients = $row['phoneno'];
	$names = $row['names'];
	$type = $row['itemtype'];
	$message = "Hello " . $names . " Your " . $itype . " document has been Found. Visit http://www.patikana.co.ke to find the location";
	$results = $gateway -> sendMessage($recipients, $message);
	if (count($results)) {
		LogFoundMessage($recipients, $names, $message, time());
	}
}

function LogFoundMessage($recipients, $names, $message, $time) {
	$query = "INSERT INTO logfoundmessages(recepient,names,message,time) VALUES('" . $recipients . "','" . $names . "','" . $message . "','" . $time . "')";
	$result = @mysql_query($query);
	/*
	 if($result){
	 return true;
	 }else{
	 return false;
	 }*/

}

//returns the human readable format location
function getGeoLocation($address) {
	$ipLite = new ip2location_lite();
	$ipLite -> setKey('191520fc91341060c8c1f31f6c6e8238012acdd2b5f9a94cf00303c705acf3ee');
	//Get errors and locations
	$locations = $ipLite -> getCity($_SERVER['REMOTE_ADDR']);
	$errors = $ipLite -> getError();
	//reversing the longitude and latitude into human readable form
	$city = $locations['cityName'];
	$region = $locations['regionName'];
	$country = $locations['counrtyName'];

	$location = array("city" => $city, "region" => $region, "country" => $country);

	return $location;

}
?>