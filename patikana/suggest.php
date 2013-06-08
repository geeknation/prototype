<?php
include 'dbconn.inc.php';
include "api/Search.php";
$agent = new Search();
$item = mysql_real_escape_string(addslashes($_GET['value']));
//fetch all the suggest data from all documents.
$natdata = $agent -> suggestNationalId($item);
$schdata = $agent -> suggestSchoolId($item);
$atmdata = $agent -> suggestAtmCard($item);

$passportdata=$agent->suggestPassport($item);

$names=$agent->suggestNames($item);

$suggestdata = $natdata . $schdata . $atmdata.$passportdata;

echo $natdata . $schdata . $atmdata.$passportdata.$names;?>