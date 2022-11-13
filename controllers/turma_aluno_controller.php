<?php 
	if(isset($_GET['src'])){
		$type = $_GET['src'];
	}
	if(isset($_GET['action'])){
		$action = $_GET['action'];
	}
	require_once('../proj_esc_func/controllers/class_student_controller.php');
?>