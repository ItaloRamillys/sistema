<?php 

	session_start();
	
	if(!isset($_SESSION['authentic'])){
		header("Location: ..\index.php?login=erro2");
	}


?>
