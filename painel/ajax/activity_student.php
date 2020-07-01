<?php
session_start();
require_once('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');
$conexao = new Conexao();
$conexao = $conexao->conectar();

$result = array();

foreach(array_keys($_POST) as $var)
{
    $filtered[$var] = filter_input(INPUT_POST, $var, FILTER_SANITIZE_SPECIAL_CHARS);
}

$user_id = $_SESSION['user_id'];
$id_activity = explode("-", $filtered['id_atv']);
$query_activity = "select * from atividade where id_atv = " . $id_activity[1];
$stmt = $conexao->query($query_activity);

if($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
	$id_DT = $dados['id_DT'];
	$query_verify = "select ano, id_turma from disc_turma where id_DT = " . $id_DT;
	$stmt_verify = $conexao->query($query_verify);
	$dados_verify = $stmt_verify->fetch(PDO::FETCH_ASSOC);

	if($dados_verify){
		$ano = $dados_verify['ano'];
		$id_turma = $dados_verify['id_turma'];
		$query_verify2 = "select id_TA from turma_aluno where id_aluno = " . $user_id . " and ano = " . $ano . " and id_turma = " . $id_turma;
		$stmt_verify2 = $conexao->query($query_verify);
		if($dados_verify2 = $stmt_verify2->fetch(PDO::FETCH_ASSOC)){
			$result['status'] = 1;
			$result['title'] = $dados['titulo_atv'];
			$result['desc'] = $dados['desc_atv'];
			$result['create_at'] = $dados['create_at'];
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
