<?php
include 'dbconn.inc.php';
$names=strtolower($_POST['attemptnames']);
$number=$_POST['docnumber'];

verifyOwner($names, $number);

function verifyOwner($names,$idnumber)
{	
	$query="SELECT names,type FROM reported WHERE number='".$idnumber."' AND claimed=0";
	$result=mysql_query($query);
	$dbnames='';
	while($row=mysql_fetch_array($result))
	{
		$dbnames=strtolower($row['names']);
		continue;
	}
	similar_text($dbnames, $names,$similarity);
	
	
	
	if($similarity<47)
	{
		header("Location: itsmine.php?error=nomatch&itemtype=national id&idnumber=$idnumber");
	}
	else
	{
		header("Location: founddocument.php?docnumber=$idnumber");
	}
}
?>