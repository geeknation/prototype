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
	}
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

		$location = 'kenya';
		include 'dbconn.inc.php';
		$ip = $this -> getIpAddress();
		$check = mysql_query("SELECT ipadress FROM sitecounter WHERE ip='" . $ip . "';");
		$times = 1;
		if (mysql_num_rows($check) == 0) {
			$result = mysql_query("INSERT INTO sitecounter(ipadress,location) VALUES ('" . $ip . "','" . $location . "') ;") or die(mysql_error());
		}
	}
		$result = mysql_query("SELECT * FROM sitecounter");
		$allvisitors = mysql_num_rows($result);
		return $allvisitors;
	}
		$query = "SELECT viewsnumber FROM pageviews WHERE pagename='" . $pagename . "'";
		$result = mysql_query($query);
		while ($row = mysql_fetch_array($result)) {
			$views = $row['viewsnumber'];
		}
		$total = $views;
		return $total;
	}
