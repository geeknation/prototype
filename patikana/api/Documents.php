<?php

/*

 *THIS CLASS PERFORMS THE FUNCTIONS OF FETCHING ALL THE DOCUMENTS STRORED IN THE DATABASE

 * COPY 1012

 *
 */
include "dbconn.inc.php";
class Documents {

	function all_national_ids() {

		$queryallnationalids = "SELECT * FROM national_ids";

		$resultallnational = mysql_num_rows(mysql_query($queryallnationalids));

		return $resultallnational;

	}

	function all_school_ids() {

		$queryallschoolids = "SELECT * FROM school_ids";

		$resultallschoolids = mysql_num_rows(mysql_query($queryallschoolids));

		return $resultallschoolids;

	}

	function all_atm_cards() {

		$queryallatms = "SELECT * FROM atm_cards";

		$resultallatms = mysql_num_rows(mysql_query($queryallatms));

		return $resultallatms;

	}

	function all_passports() {

		$queryallpassports = "SELECT * FROM passports";

		$resultallpassports = mysql_num_rows(mysql_query($queryallpassports));

		return $resultallpassports;

	}

	function all_docs_uploaded() {

		$resultallnational = $this -> all_national_ids();

		$resultallschoolids = $this -> all_school_ids();

		$resultallatms = $this -> all_atm_cards();

		$resultallpassports = $this -> all_passports();

		$total_docs = (int)$resultallnational + (int)$resultallschoolids + (int)$resultallatms + (int)$resultallpassports;

		return $total_docs;

	}

	function getStatus($l) {

		if ($l == 0) {

			return "<div class='notlocked'>Not claimed</div>";

		} else {
			return "<div class='locked'>Claimed</div>";
		}

	}

	function disp_national_ids($fid) {
		include "dbconn.inc.php";
		$query = "SELECT * FROM reported WHERE id='$fid' AND type='National ID'";
		$result = mysql_query($query) or die(mysql_error());

		$count = mysql_num_rows($result);
		if ($count == 0) {
			echo '<div class="alert alert-warning">You havent yet uploaded any lost National IDS information yet</div>';
		} else {
			echo "
			<table class='table table-striped'>
			<th>ID Number</th>
			<th>Time reported</th>
			<th>Claimed</th>
		";
			while ($row = mysql_fetch_array($result)) {
				$idnumber = $row['number'];
				$time = date("D-m-Y g:i:s", $row['timereported']);
				$i = $row['claimed'];
				$status = $this -> getStatus($i);
				echo "
				<tr>
				<td>
					$idnumber			
				</td>
				<td>
					$time
				</td>
				<td>
					$status
				</td>
				</tr>

			";

			}
			echo "</table>";
		}
	}

	function disp_school_ids($fid) {
		$query = "SELECT * FROM reported WHERE id='$fid' AND type='School ID'";

		$result = mysql_query($query);
		$count = mysql_num_rows($result);
		if ($count == 0) {
			echo '<div class="alert alert-warning">You havent yet uploaded any lost School IDS information yet</div>';
		} else {
			echo "
			<table class='table table-striped'>
			<th>School ID Number</th>
			<th>Time reported</th>
			<th>Claimed</th>
		";

			while ($row = mysql_fetch_array($result)) {
				$idnumber = $row['number'];
				$time = date("D-m-Y", $row['timereported']);
				$i = $row['claimed'];
				$status = $this -> getStatus($i);
				echo "
				<tr>
				<td>
				$idnumber
				</td>
				<td>
				$time
				</td>
				<td>
				$status
				</td>
				</tr>

			";
			}
		}
	}

	function disp_atms($fid) {
		$query = "SELECT * FROM reported WHERE id='$fid' AND type='ATM card'";
		$result = mysql_query($query) or die(mysql_error());

		$count = mysql_num_rows($result);

		if ($count == 0) {
			echo '<div class="alert alert-warning">You havent yet uploaded any lost ATM cards information yet</div>';
		} else {
			echo "
			<table class='table table-striped'>
			<th>ATM Number</th>
			<th>Time reported</th>
			<th>Claimed</th>
		";
			while ($row = mysql_fetch_array($result)) {
				$idnumber = $row['number'];
				$time = date("D-m-Y", $row['timereported']);
				$i = $row['claimed'];
				$status = $this -> getStatus($i);
				echo "
				<tr>
				<td>
				$idnumber
				</td>
				<td>
				$time
				</td>
				<td>
				$status
				</td>
				</tr>

			";
			}
		}

	}

	function disp_pass($fid) {
		$query = "SELECT * FROM reported WHERE id='$fid' AND type='Passport'";

		$result = mysql_query($query);

		$count = mysql_num_rows($result);
		if ($count == 0) {
			echo '<div class="alert alert-warning">You havent yet uploaded any lost passport information yet</div>';
		} else {
			echo "
			<table class='table table-striped'>
			<th>Passport Number</th>
			<th>Time reported</th>
			<th>Claimed</th>
		";
			while ($row = mysql_fetch_array($result)) {
				$idnumber = $row['number'];
				$time = date("D-m-Y", $row['timereported']);
				$i = $row['claimed'];
				$status = $this -> getStatus($i);
				echo "
				<tr>
				<td>
					$idnumber
				</td>
				<td>
					$time
				</td>
				<td>
					$status
				</td>
				</tr>

			";
			}
		}

	}

	function recoverItem($docnumber,$agent) {
		$idnumber = $docnumber;
		include 'dbconn.inc.php';
		$query = "SELECT * FROM reported WHERE number='" . $idnumber . "' LIMIT 1";

		$results = mysql_query($query, $conn) or die(mysql_error());

		$tabledata = '';

		$end = "</div>";

		$tableheader = <<<EOD
<table align="center" width="100%" border="0">
EOD;

		$row = mysql_fetch_assoc($results);
		$finderid = $row['id'];
		$foundnames = $row['names'];
		$idnumber = $row['number'];
		$itemtype=$row['type'];
		$locationfound = $row['locationfound'];

		$finder = $this -> getFinderDetails($finderid);

		$tabledata .= <<<EOD
<tr height='50'>
<td><b>Names</b></td>
<td>$foundnames</td>
</tr>

<tr height='50'>
<td><b>idnumber</b></td>
<td id='docnumber'>$idnumber</td>
</tr>
<tr height='50'>
<td><b>locationfound</b></td>
<td>$locationfound</td>
</tr>

EOD;

		$tablefooter = '</table>';

		$table = <<<EOD
$tableheader
$tabledata
$tablefooter
EOD;

		$start = '
<div class="heading">
			lost id details
						</div>
	<div id="lostdetails" class="appear">
						
' . $table;

		$data = $start . $end . $finder;

		echo $data;
		include ("Search.php");
		$searcher=new Search();
		$searcher->saveSuccessfulSearch($idnumber, $itemtype, $locationfound,$agent);

	}

	function getFinderDetails($docid) {

		$query = "SELECT users.user_id,users.names,user_phoneno.phone_number FROM users INNER JOIN user_phoneno ON users.user_id=user_phoneno.user_id WHERE users.user_id='" . $docid . "'";

		$result = mysql_query($query) or die(mysql_error());

		$result = mysql_fetch_array($result);

		$findersname = $result['names'];
		$phonenumber = $result['phone_number'];

		$tableheader = <<<EOD
<table align="center" width="100%" border="0" style="">
EOD;

		$tablefooter = '</table>';
		$tabledata = <<<EOD

<tr height='50'>
<td><b>found by</b></td>
<td>$findersname</td>
</tr>

<tr height='50'>
<td><b>phonenumber:</b></td>
<td>$phonenumber</td>
</tr>
EOD;

		$table = <<<EOD
$tableheader
$tabledata
$tablefooter

EOD;

		$end = "</div>";

		$start = '
	<div class="heading">finders details</div>
	<div id="findersdetails" class="appear">

	
	' . $table;

		$data = $start . $end;

		return $data;
	}

}
?>