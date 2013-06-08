<?php
include "dbconn.inc.php";
include "api/Search.php";
$agent=new Search();
$v=$_POST['value'];
if($v=='' || empty($v)){
	echo "<b><h3>please enter a value</h3></b>";
	exit();
}
$agent->searchLost($v,"pc");
?>