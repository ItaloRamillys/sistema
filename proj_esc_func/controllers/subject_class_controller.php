<?php 
session_start();
require('C:\xampp\htdocs\sistema\proj_esc_func\model\subject_class.php');
require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\subject_class_service.php');
require('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');

$conn = new Connection();
$subject_class = new SubjectClass();

if($action == 'delete'){
	$subject_class->__set('id_subject_class', ($_GET['id_subject_class']));
	$turma_aluno_service = new SubjectClassService($conn, $subject_class);
	$turma_aluno_service->delete();
}else if($action == 'cad'){
	$id_subject = $_POST['id_subject'];
	$id_class = $_POST['id_class'];
	$id_teacher = $_POST['id_teacher'];
	$year = $_POST['year'];
	$id_author_insert = $_SESSION['user_id'];

	$subject_class->__set('id_subject', $id_subject);
	$subject_class->__set('id_class', $id_class);
	$subject_class->__set('id_teacher', $id_teacher);
	$subject_class->__set('year', $year);
	$subject_class->__set('id_author_insert', $id_author_insert);

	$subject_class_service = new SubjectClassService($conn, $subject_class);
	echo json_encode($subject_class_service->insert());
}
?>