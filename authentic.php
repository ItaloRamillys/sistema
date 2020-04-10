<?php 

	session_start();
	
	if(!isset($_SESSION['authentic']) || $_SESSION['authentic'] == 'NO'){
		header("Location: ..\index.php?login=erro2");
	}

?>
