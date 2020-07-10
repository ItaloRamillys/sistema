<?php 
require('C:\xampp\htdocs\sistema\proj_esc_func\model\class_student.php');
require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\class_student_service.php');
require('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');

$conn = new Connection();

$class_student = new ClassStudent();

if($acao == 'delete'){
	$class_student->__set('id_ta', stripcslashes($_GET['ta']));
	$class_student->__set('id_class', stripcslashes($_GET['id_class']));
	$class_student_service = new TurmaAlunoService($conn, $class_student);
	$class_student_service->delete();
}
else if($acao == 'cad'){
	$alunos = $_POST['id_student'];
	$id_class = $_POST['id_class'];
	$year = $_POST['year'];

	$class_student->__set('year', $year);
	$class_student->__set('id_class', $id_class);
	$class_student->__set('id_student', $id_student);

	$class_student_service = new ClassStudentService($conn, $class_student);
	$class_student_service->insert();
}
?>