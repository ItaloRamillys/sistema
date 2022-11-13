<?php 

require('C:\xampp\htdocs\sistema\proj_esc_func\model\grade.php');
require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\grade_service.php');
require('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');

$conn = new Connection();

$grade = new Grade();

if($action == 'delete'){
	$grade->__set('id_ta', stripcslashes($_GET['ta']));
	$grade->__set('id_turma', stripcslashes($_GET['turma_del']));
	$nota_service = new TurmaAlunoService($conexao, $nota);
	$nota_service->delete();
}
else if($action == 'cad'){

	$array = array_values($_POST);
	$array_ids = [];
	$array_notas = [];

	for ($i = 0; $i < count($array[4]); $i++) { 	
			$array_notas[$i] = $array[4][$i];
	}
 
	for ($i = 0; $i < count($array_notas); $i++) { 
			$array_ids[$i] = base64_decode($array[3][$i]); 
	}

	$periodo = $_POST['periodo'];

	$turma_ano = explode('-', $_POST['turma_ano']);	
	$id_DT = $turma_ano[3];

	$grade->__set('id_student', $array_ids);
	$grade->__set('period', $periodo);
	$grade->__set('id_SC', $id_DT);
	$grade->__set('value_grade', $array_notas);

	$nota_service = new GradeService($conn, $grade);
	
	echo json_encode($nota_service->insert());
	
}

?>