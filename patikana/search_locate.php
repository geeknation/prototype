<?php
include "dbconn.inc.php";
include "api/Search.php";
$agent=new Search();
$v=$_POST['value'];
if($v=='' || empty($v)){
	echo "
	exit();
}
$agent->searchLost($v,"pc");
?>