<?php 
require('C:\xampp\htdocs\sistema\proj_esc_func\model\class_student.php');
require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\class_student_service.php');
require('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');

$conn = new Connection();
$class_student = new ClassStudent();

if($action == 'delete'){
	$class_student->__set('id_ta', stripcslashes($_GET['ta']));
	$class_student->__set('id_class', stripcslashes($_GET['id_class']));
	$class_student_service = new TurmaAlunoService($conn, $class_student);
	$class_student_service->delete();
}
else if($action == 'cad'){
	$id_student = $_POST['id_student'];
	$id_class = $_POST['id_class'];
	$year = date('Y');

	$class_student->__set('year', $year);
	$class_student->__set('id_class', $id_class);
	$class_student->__set('id_student', $id_student);

	$class_student_service = new ClassStudentService($conn, $class_student);
	echo json_encode($class_student_service->insert());
}
?>