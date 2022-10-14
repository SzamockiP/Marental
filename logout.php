<?php
	session_start();
	if(isset($_SESSION["last_page"]))
		if($_SESSION["last_page"] == "profile.php")
			header("Location: index.php");
		else
			header('Location:'.$_SESSION['last_page']);		
	else
		header("Location: index.php");
	session_unset();
?>