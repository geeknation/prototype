<?php

include "dbconn.inc.php";

include 'ptk_functions.php';



$names=htmlspecialchars(htmlentities(mysql_escape_string(addslashes($_POST['names']))));

$username=htmlspecialchars(htmlentities(mysql_escape_string(addslashes($_POST['username']))));

$location=htmlspecialchars(htmlentities(mysql_escape_string(addslashes($_POST['location']))));

$gender=htmlspecialchars(htmlentities(mysql_escape_string(addslashes($_POST['gender']))));

$countrycode=$_POST["countrycode"];

$phone=htmlspecialchars(htmlentities(mysql_escape_string(addslashes($_POST['phoneno']))));

$email=htmlspecialchars(htmlentities(mysql_escape_string(addslashes($_POST['email']))));

$question=htmlspecialchars(htmlentities(mysql_escape_string(addslashes($_POST['question']))));

$answer=htmlspecialchars(htmlentities(mysql_escape_string(addslashes($_POST['answer']))));

$password=htmlspecialchars(htmlentities(mysql_escape_string(addslashes($_POST['password']))));

$yob=$_POST['day'].$_POST['month'].$_POST['year'];

$phonenumber=$countrycode.(int)$phone;

$uid=ptk_uniq_id();

$query="INSERT INTO login(user_id,username, password) VALUES('".$uid."','".$username."','".md5($password)."')";



$query2="INSERT INTO users(user_id,names,location,yob,gender,timecreated) VALUES('".$uid."','".$names."',

'".$location."','".$yob."','".$gender."','".time()."')";



$query3="INSERT INTO user_phoneno(user_id,phone_number) VALUES('".$uid."','".$phonenumber."')";



$query4="INSERT INTO user_email(user_id,emailadress) VALUES('".$uid."','".$email."')";



$query5="INSERT INTO account_recovery(user_id,choosen_question,choosen_answer) VALUES('".$uid."','".$question."','".$answer."')";



$result=mysql_query($query)or die(mysql_error());



$result1=mysql_query($query2) or die(mysql_error());



$result2=mysql_query($query3) or die(mysql_error());



$result3=mysql_query($query4) or die(mysql_error());



$result4=mysql_query($query5) or die(mysql_error());



if($result1==true  and $result==true and $result2==true and $result3==true and $result4==true){
	header("location: sucessregistration.php");
}

else{
	header("location: failregistration.php");
}




?>