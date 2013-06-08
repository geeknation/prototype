<?php
error_reporting(0);
/* * THIS IS A CLASS THAT IMPLEMENTS THE SEARCH FUNCTIONS THAT ARE USED
 * ACROSS THIS APPLICATION
 * COPYRIGHT 2012
 */session_start();
class Search {
	//this function searches for the lost document and returns the results to the user
	function searchLost($number, $agent) {		if (empty($number)) {			echo "empty";		} else {			global $user;			if (isset($_SESSION['user_allow'])) {				$user = $_SESSION['user_allow'];			} else {				$user = "visitor";			}			$a = "Searched";			global $query,$type;			$type="document";			$query = "SELECT * FROM reported WHERE number='" . $number . "' AND claimed=0";			$result = mysql_query($query);			$confirmresult = mysql_num_rows($result);			if ($confirmresult >= 1) {				if ($agent == "pc") {					$this -> disp_pc($query, $a, $user,$confirmresult);				}				else{					$this -> disp_mobile($query, $a, $user);				}			} else {				echo "Seems we have not yet found your item<br/><input type='button' class='btn btn-success' id='0_announce' value='Tell us you lost your item' onclick='_announceUI()'/>";				$this -> saveUnSuccessfulSearch($number,$type,$agent);			}		}
	}	function disp_pc($query, $a, $user,$confirmresult) {		$result = mysql_query($query);		echo '<u class="resultcounter">' . $confirmresult . 'result(s) found</u><p/><div class="resultholder">';		$tableheader = <<<EOD		<table align="left" border='0' class="table" id="result_table">			  <tr align="left">			  <th>Item number</th>	   			  <th>Names</th>	    			  </tr>EOD;		$tabledata = '';		$itemtype = '';		while ($row = mysql_fetch_array($result)) {			$foundnames = $this -> name_shuffle($row['names']);			$idnumber = $row['number'];			$itemtype = $row['type'];			$tabledata .= <<<EOD			<tr align='left' style='font-size:18px;' height='30'>			<td width="60"><b>$idnumber</b></td>			<td width="120" class="foundnames_td">$foundnames</td>			</tr>			<tr>			<td></td>			<td class="claimholder" align="center">							<a href="itsmine.php?idnumber=$idnumber&itemtype=$itemtype" class="found_link">				<div class="button btn-large btn-link">				CLAIM				</div>				</a>												</td>			</tr>EOD;		}		$this -> storeActivity($a, $user, $itemtype);		$tablefooter = '</table></div>';		$table = <<<EOD				$tableheader				$tabledata				$tablefooterEOD;		echo $table;			}	function disp_mobile($query, $a, $user) {		$result = mysql_query($query);		$itemtype = '';		$resultcount=mysql_num_rows($result);				echo '<p>'.$resultcount.' result(s) found</p>';			while ($row = mysql_fetch_array($result)) {				$foundnames = $this -> name_shuffle($row['names']);				$idnumber = $row['number'];				$itemtype = $row['type'];				echo '								<div style="background:#fff; border:solid thin #000,width:80%; margin:0 auto; margin-top:2%">				<table id="resultable" class="table" align="center">						<tr>						<td>							<b>Document number:</b>						</td>						</tr>
						<tr>						<td>							'.$idnumber.'							<hr/>						</td>						</tr>						<tr><td><b>Names</b></td></tr>
						<tr><td>'.$foundnames.'<hr/></td></tr>
						<tr><td><b>document type</b></td></tr>
						<tr><td>'.$itemtype.'<hr/></td></tr>
						<tr><td>						<a href="itsmine.php?idnumber='.$idnumber.'&itemtype='.$itemtype.'" id="" data-role="button" data-theme="b">							CLAIM						</a>						</td></tr>					';
			}			echo "</table></div>";			$this -> storeActivity($a, $user, $itemtype);			}	function sucess_searches() {
		$querysucesstable = "SELECT * FROM success_search_table";
		$resultsucess = mysql_query($querysucesstable);
		$totalsucess = mysql_num_rows($resultsucess);
		return $totalsucess;
	}	function fail_searches() {
		$queryfailtable = "SELECT * FROM fail_search_table";
		$resultfail = mysql_query($queryfailtable);
		$totalfail = mysql_num_rows($resultfail);
		return $totalfail;
	}	function all_searches() {
		$totalsucess = $this -> sucess_searches();
		$totalfail = $this -> fail_searches();
		$totalsearches = (int)$totalsucess + (int)$totalfail;
		return $totalsearches;
	}	function sucess_nationalids_searches() {
		$query = "SELECT * FROM success_search_table WHERE item_type='National Id'";
		$result = mysql_query($query);
		$sucessnationalsearches = mysql_num_rows($result);
		return $sucessnationalsearches;
	}	function sucess_schoolids_searches() {
		$query = "SELECT * FROM success_search_table WHERE item_type='School Id'";
		$result = mysql_query($query);
		$sucessschoolsearches = mysql_num_rows($result);
		return $sucessschoolsearches;
	}	function sucess_atm_searches() {
		$query = "SELECT * FROM success_search_table WHERE item_type='Atm Card'";
		$result = mysql_query($query);
		$sucessatmsearches = mysql_num_rows($result);
		return $sucessatmsearches;
	}	function sucess_passport_searches() {
		$query = "SELECT * FROM success_search_table WHERE item_type='Passport'";
		$result = mysql_query($query);
		$sucessatmsesarches = mysql_num_rows($result);
		return $sucessatmsesarches;
	}	function failed_nationalids_searches() {
		$query = "SELECT * FROM fail_search_table WHERE item_type='National Id'";
		$result = mysql_query($query);
		$failnationalsearches = mysql_num_rows($result);
		return $failnationalsearches;
	}	function failed_schoolids_searches() {
		$query = "SELECT * FROM fail_search_table WHERE item_type='School Id'";
		$result = mysql_query($query);
		$failschoolsearches = mysql_num_rows($result);
		return $failschoolsearches;
	}	function failed_atm_searches() {
		$query = "SELECT * FROM fail_search_table WHERE item_type='Atm Card'";
		$result = mysql_query($query);
		$failatmsearches = mysql_num_rows($result);
		return $failatmsearches;
	}	function failed_passport_searches() {
		$query = "SELECT * FROM fail_search_table WHERE item_type='Passport'";
		$result = mysql_query($query);
		$failatmsesarches = mysql_num_rows($result);
		return $failatmsesarches;
	}	function saveSuccessfulSearch($itemid, $itemtype, $locationfound,$agent) {
		require_once 'Timekeeper.php';		include "dbconn.inc.php";

		$timestamp = time();
		//Before the save seach to see if the id has been searched
		$ifexists = "SELECT item_id FROM success_search_table WHERE item_id= '" . $itemid . "';";
		$result = mysql_query($ifexists) or die(mysql_error());		$count=mysql_num_rows($result);
		if ($count==0) {
			//Save a new
			$query = "INSERT INTO success_search_table(item_id,location_found,item_type,last_web_search,agent) VALUES('" . $itemid . "','" . $locationfound . "','" . $itemtype . "','" . $timestamp . "','".$agent."') ;";
			$proc=mysql_query($query) or die(mysql_error());			
		}//End if
		else {
			/*increment times*/
			//First query to get the times searched
			$checktimes = "SELECT web_times FROM success_search_table WHERE item_id= '" . $itemid . "';";
			$checkTimesResult = mysql_query($checktimes);
			while ($row = mysql_fetch_assoc($checkTimesResult)) {
				$times = $row['web_times'];
			}//End while
			//update the times (increment once)
			$times += 1;
			//Update the database (times field)
			$updateQuery = "UPDATE success_search_table SET web_times='" . $times . "',last_web_search='" . $timestamp . "' WHERE item_id='" . $itemid . "';";
			mysql_query($updateQuery) or die(mysql_error());
		}//End else
	}//End function saveSuccessfulSearch	function saveUnSuccessfulSearch($itemid, $itemtype,$agent) {
		//Before the save seach to see if the id has been searched
		require_once 'Timekeeper.php';
		$timestamp = time();
		$ifexists = "SELECT item_id FROM fail_search_table WHERE item_id= '" . $itemid . "';";
		$result = mysql_query($ifexists) or die(mysql_error());		$count=mysql_num_rows($result);
		if ($count ==0) {
			//Save a new
			$query = "INSERT INTO fail_search_table (item_id,item_type,last_web_search,agent) VALUES ('" . $itemid . "','" . $itemtype . "','" . $timestamp . "','".$agent."') ;";
			mysql_query($query) or die(mysql_error());			
		}//End if
		else {
			/*increment times*/
			//First query to get the times searched
			$checktimes = "SELECT web_times FROM fail_search_table WHERE item_id= '" . $itemid . "';";
			$checkTimesResult = mysql_query($checktimes);
			while ($row = mysql_fetch_assoc($checkTimesResult)) {
				$times = $row['web_times'];
			}//End while
			//update the times (increment once)
			$times += 1;
			//Update the database (times field)
			$updateQuery = "UPDATE fail_search_table SET web_times='" . $times . "',last_web_search='" . $timestamp . "' WHERE item_id='" . $itemid . "';";
			mysql_query($updateQuery) or die(mysql_error());
		}//End else
	}//End function saveUnsuccessfulSearch	function name_shuffle($string) {
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
		for ($i = 0; $i <= $length - 1; $i++) {
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
	}		function suggestNationalId($item) {		$result = mysql_query("SELECT names,number,type FROM reported WHERE type='National ID' AND number LIKE '" . $item . "%' AND claimed=0 ORDER BY number asc LIMIT 0,5") or die(mysql_error());		$alldata = '';		while ($row = mysql_fetch_assoc($result)) {			$alldata .= "<div class='link' onclick='addText(\"" . $row['number'] . "\");'>" . $this -> boldThat($item, $row['number']) . "	<div class='names'>" . $row['type'] . "</div></div>";		}		return $alldata;	}	function suggestSchoolId($item) {		$result = mysql_query("SELECT names,number,type FROM reported WHERE type='School ID' AND number LIKE '" . $item . "%' AND claimed=0 ORDER BY number asc LIMIT 0,5") or die(mysql_error());		$alldata = '';		while ($row = mysql_fetch_assoc($result)) {			$alldata .= "<div class='link' onclick='addText(\"" . $row['number'] . "\");'>" . $this -> boldThat($item, $row['number']) . "	<div class='names'>" . $row['type'] . "</div></div>";		}		return $alldata;	}	function suggestAtmCard($item) {		$result = mysql_query("SELECT names,number,type FROM reported WHERE type='ATM card' AND number LIKE '" . $item . "%' AND claimed=0 ORDER BY number asc LIMIT 0,5") or die(mysql_error());		$alldata = '';		while ($row = mysql_fetch_assoc($result)) {			$alldata .= "<div class='link' onclick='addText(\"" . $row['number'] . "\");'>" . $this -> boldThat($item, $row['number']) . "	<div class='names'>" . $row['type'] . "</div></div>";		}		return $alldata;	}	function suggestPassport($item) {		$result = mysql_query("SELECT names,number FROM reported WHERE type='Passport' AND number LIKE '" . $item . "%' AND claimed=0 ORDER BY number asc LIMIT 0,5") or die(mysql_error());		$alldata = '';		while ($row = mysql_fetch_assoc($result)) {			$alldata .= "<div class='link' onclick='addText(\"" . $row['number'] . "\");'>" . $this -> boldThat($item, $row['number']) . "	<div class='names'>" . $row['type']. "</div></div>";		}		return $alldata;	}	function suggestNames($item) {		$result = mysql_query("SELECT names,number,type FROM reported WHERE names LIKE '" . $item . "%' AND claimed=0 ORDER BY number asc LIMIT 0,5") or die(mysql_error());		$alldata = '';		while ($row = mysql_fetch_assoc($result)) {			$alldata .= "<div class='link' onclick='addText(\"" . $row['number'] . "\");'>" .$row['number']. "	<div class='names'>" . $row['type'] . "</div></div>";		}		return $alldata;	}	function boldThat($itempart, $realValue) {
		$length = strlen($itempart);
		$length2 = strlen($realValue);
		$mainlength = $length - $length2;
		$notbolded = substr($realValue, 0, $mainlength);
		$bolded = substr($realValue, $mainlength);
		return $notbolded . "<strong>" . $bolded . "</strong>";
	}	function storeActivity($a, $u, $type) {		$geodata = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']));		$c = $geodata['geoplugin_city'];		$r = $geodata['geoplugin_region'];		$l = $r . "," . $c;		$query = "INSERT INTO livestream(action,time,name,location,itemtype) VALUES('" . $a . "','" . time() . "','" . $u . "','" . $l . "','" . $type . "')";		$result = mysql_query($query) or die(mysql_error);		if ($result) {			return true;		} else {			return false;		}	}}?>