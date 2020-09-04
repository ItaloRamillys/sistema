<?php
session_start();
require_once('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');
$conn = new Connection();
$conn = $conn->connect();

$result = array();

foreach(array_keys($_POST) as $var)
{
    $filtered[$var] = filter_input(INPUT_POST, $var, FILTER_SANITIZE_SPECIAL_CHARS);
}

$user_id = $_SESSION['user_id'];
$id_activity = explode("-", $filtered['id_atv']);
$query_activity = "select * from activity where id_activity = " . $id_activity[1];
$stmt = $conn->query($query_activity);

if($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
	$id_DT = $dados['id_SC_activity'];
	$query_verify = "select year, id_class from subject_class_lesson where id_sc = " . $id_DT;
	$stmt_verify = $conn->query($query_verify);
	$dados_verify = $stmt_verify->fetch(PDO::FETCH_ASSOC);

	if($dados_verify){
		$ano = $dados_verify['year'];
		$id_class = $dados_verify['id_class'];
		$query_verify2 = "select id_CS from student_class where id_student = " . $user_id . " and year = " . $ano . " and id_class = " . $id_class;
		$stmt_verify2 = $conn->query($query_verify);
		if($dados_verify2 = $stmt_verify2->fetch(PDO::FETCH_ASSOC)){
			$result['status'] = 1;
			$result['title'] = $dados['title_activity'];
			$result['desc'] = $dados['desc_activity'];
			$result['create_at'] = $dados['created_at'];
		}else{
			$result['status'] = 0;
			$result['title'] = "Erro";
			$result['desc'] = "Você não tem acesso a esta atividade";
		}
	}else{
		$result['status'] = 0;
		$result['title'] = "Erro";
		$result['desc'] = "A atividade não pertence a sua turma";
	}
}else{
	$result['status'] = 0;
	$result['title'] = "Erro";
	$result['desc'] = "Atividade inválida";
}
echo json_encode($result);
?>
