<?php
	session_start(); 
	
	//session_destroy();
	
	unset($_SESSION["adid"]);
	unset($_SESSION["adnm"]);
	
	header("location: index.php"); 
?>