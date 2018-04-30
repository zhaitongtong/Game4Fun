<?php
	session_start();
	
	$_SESSION["utype"] = $_POST["utype"];

	if ($_SESSION["utype"] == "Personal") {
		header("Location: personal_reg.php");
    	exit;
	} else if ($_SESSION["utype"] == "Business"){
		header("Location: business_reg.php");
    	exit;
	}else {
		$_SESSION["rep"] = "no way, you have no power to do this";
		header("Location: login_next.php");
		exit;
	}

?>