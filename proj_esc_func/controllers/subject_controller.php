<?php 
require('C:\xampp\htdocs\sistema\proj_esc_func\model\subject.php');
require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\subject_service.php');
require('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');

$conn = new Connection();
$subject = new Subject();

if($action == 'cad'){
	session_start();
	$code = $_POST['code_subject'];
	$name = $_POST['name_subject'];
	$id_author_insert = $_SESSION['user_id'];

	$subject->__set('name_subject', $name);
	$subject->__set('code_subject', $code);
	$subject->__set('id_author_insert', $id_author_insert);
	
	$subject_service = new SubjectService($conn, $subject);
	echo json_encode($subject_service->insert());
}elseif($action == 'edit'){
	$id_author_update = $_POST['id_author_update'];
	$subject->__set('id_author_update', $id_author_update);
	$subject->__set('id_subject', $_POST['id_subject']);
	
	$subject_service = new SubjectService($conn, $subject);
	echo json_encode($subject_service->update());
}
?>