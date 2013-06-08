<?php

session_start();



if(isset($_SESSION['user_allow']))

{



	session_unset();

	header("Location: index.php");

}

?>