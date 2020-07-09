<?php 
	require('C:\xampp\htdocs\sistema\proj_esc_func\model\subject.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\subject_service.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');

	$conn = new Connection();
	$subject = new Subject();

	$code = $_POST['code_subject'] ? $_POST['code_subject'] : NULL;
	$name = $_POST['name_subject'] ? $_POST['name_subject'] : NULL;

	$subject->__set('name_subject', $name);
	$subject->__set('code_subject', $code);

	$subject_service = new SubjectService($conn, $subject);

	if($action == 'cad'){
		echo json_encode($subject_service->insert());
	}elseif($action == 'edit'){
		$subject->__set('id_subject', $_POST['id_subject']);
		echo json_encode($subject_service->update());
	}
?>