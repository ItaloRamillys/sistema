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
	$query_verify = "select * from disc_turma where id_DT = " . $id_DT . " and id_prof = " . $user_id;
	$stmt_verify = $conexao->query($query_verify);
	$dados_verify = $stmt_verify->fetch(PDO::FETCH_ASSOC);

	if($dados_verify){
		$result['status'] = 1;
		$result['title'] = $dados['titulo_atv'];
		$result['desc'] = $dados['desc_atv'];
		$result['create_at'] = $dados['create_at'];
	}
}

echo json_encode($result);
?>
