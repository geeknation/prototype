<?php
/*
 *PatikanaAdmin.class
 * THIS CLASS PERFORMS WEB ADMINISTRATIVE FUNCTIONS ON THE APPLICATION
 */
require "dbconn.inc.php";
class PatikanaAdmin {
	function system_success_rate() {
		$totalsearches = $this -> all_searches();
		$sucesstotal = $this -> sucess_searches();
		$failtotal = $this -> fail_searches();
		$decimalratesucess = (int)$sucesstotal / (int)$totalsearches;
		$sucessrate = $decimalratesucess * 100;
		return round($sucessrate, 2);
	}	function pageviews($pageid, $pagename) {
		include 'dbconn.inc.php';
		$pageview = 1;
		$checkexists = "SELECT pagename FROM pageviews WHERE pagename='" . $pagename . "'";
		$result = mysql_query($checkexists);
		if (mysql_affected_rows() != 1) {
			$query = "INSERT INTO pageviews(pageid,pagename,viewsnumber) VALUES('" . $pageid . "','" . $pagename . "','" . $pageview . "')";
			$result = mysql_query($query);
		} else {
			$queryupadatetimes = "SELECT viewsnumber FROM pageviews WHERE pagename='" . $pagename . "' ";
			$result = mysql_query($queryupadatetimes);
			while ($row = mysql_fetch_array($result)) {
				$pageview = (int)$row['viewsnumber'];
			}
			$p = $pageview + 1;
			$queryupdate = "UPDATE pageviews SET viewsnumber='" . $p . "' WHERE pagename='" . $pagename . "'";
			mysql_query($queryupdate);
		}
	}
	function ptk_visitor_counter() {
		$location = 'kenya';
		include 'dbconn.inc.php';
		$ip = $this -> getIpAddress();
		$check = mysql_query("SELECT ipadress FROM sitecounter WHERE ip='" . $ip . "';");
		$times = 1;
		if (mysql_num_rows($check) == 0) {
			$result = mysql_query("INSERT INTO sitecounter(ipadress,location) VALUES ('" . $ip . "','" . $location . "') ;") or die(mysql_error());
		}
	}	function getIpAddress() {		$ip = '';		if (!empty($_SERVER['REMOTE_ADDR'])) {			$ip = @$_SERVER['REMOTE_ADDR'];		}		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {			$ip = @$_SERVER['HTTP_CLIENT_IP'];		}		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))		//to check ip is pass from proxy		{			$ip = @$_SERVER['HTTP_X_FORWARDED_FOR'];		}		return $ip;	}	function countVistors() {
		$result = mysql_query("SELECT * FROM sitecounter");
		$allvisitors = mysql_num_rows($result);
		return $allvisitors;
	}	function pageviewtimes($pagename) {
		$query = "SELECT viewsnumber FROM pageviews WHERE pagename='" . $pagename . "'";
		$result = mysql_query($query);
		while ($row = mysql_fetch_array($result)) {
			$views = $row['viewsnumber'];
		}
		$total = $views;
		return $total;
	}	function checkUserAgent() {		if (stripos(strtolower($_SERVER["HTTP_USER_AGENT"]), 'opera') || stripos(strtolower($_SERVER["HTTP_USER_AGENT"]), 'android') || stripos(strtolower($_SERVER["HTTP_USER_AGENT"]), 'iphone') || stripos(strtolower($_SERVER["HTTP_USER_AGENT"]), 'blackberry') || stripos(strtolower($_SERVER['HTTP_USER_AGENT']), 'ipod') || stripos(strtolower($_SERVER['HTTP_USER_AGENT']), 'nokia')) {			header("Location: http://m.patikana.co.ke");		} else if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "wap") || strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "wml")) {			header("Location: http://m.patikana.co.ke/wml/");		} else {			header("Location: https://www.patikana.co.ke/Home.php");		}	}
}?>