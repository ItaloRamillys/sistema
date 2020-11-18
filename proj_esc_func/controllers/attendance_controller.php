<?php 

require('C:\xampp\htdocs\sistema\proj_esc_func\model\attendance.php');
require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\attendance_service.php');
require('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');

$conn = new Connection();

$attendance = new Attendance();

if($action == 'delete'){
	$attendance->__set('id_ta', stripcslashes($_GET['ta']));
	$attendance->__set('id_turma', stripcslashes($_GET['turma_del']));
	$frequencia_service = new TurmaAlunoService($conn, $attendance);
	$frequencia_service->delete();
}
else if($action == 'cad'){
	$date = $_POST['date'];

	$array = array_values($_POST);

	$array_ids = [];
	$array_tipos = [];

	for ($i = 0; $i < count($array[4]); $i++) { 
		if($array[4][$i] != 'p'){
			$array_ids[] = $i; 
			$array_tipos[] = $array[4][$i];
		}
	}
 
	for ($i = 0; $i < count($array_ids); $i++) { 
			$array_ids[$i] = base64_decode($array[3][$array_ids[$i]]); 
	}

	$id_user[] = $array_ids;
	$type_attendance[] = $array_tipos;

	$turma_ano = explode('-', $_POST['class_year']);

	$id_subj_class = $turma_ano[3];

	$attendance->__set('id_user', $id_user);
	$attendance->__set('type_attendance', $type_attendance);
	$attendance->__set('id_subj_class', $id_subj_class);
	$attendance->__set('date', $date);

	$attendance_service = new AttendanceService($conn, $attendance);
	echo json_encode($attendance_service->insert());
}else if($acao == 'update'){

}

?>