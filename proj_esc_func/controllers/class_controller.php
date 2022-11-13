<?php 
	require('C:\xampp\htdocs\sistema\proj_esc_func\model\class_school.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\class_service.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');

	$conn  = new Connection();
	$class = new ClassSchool();
	$class->__set('name_class', $_POST['name_class']);
	$class->__set('room', $_POST['room']);
	$class->__set('year', $_POST['year']);
	$class_service = new ClassService($conn, $class);
	echo json_encode($class_service->insert());
?>