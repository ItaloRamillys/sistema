<?php 
session_start();
if($_GET['style'] == "1"){
	unset($_SESSION['style']);
	$_SESSION['style'] = 1;
	echo json_encode($_SESSION['style']);
}else{
	unset($_SESSION['style']);
	$_SESSION['style'] = 2;
	echo json_encode($_SESSION['style']);
}

?>