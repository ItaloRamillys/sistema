<?php 
	require('C:\xampp\htdocs\sistema\proj_esc_func\model\subject.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\subject_service.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');

	$con = new Connection();
	$subject = new Subject();

	$cod = $_POST['cod_subject'] ? $_POST['cod_subject'] : NULL;
	$name = $_POST['name_subject'] ? $_POST['name_subject'] : NULL;

	$subject->__set('name_subject', $name);
	$subject->__set('cod_subject', $cod);

	$subject_service = new SubjectService($con, $subject);

	$bool = $subject_service->insert();

	echo json_encode($bool);
?>