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
	$query_verify = "select * from subject_class where id_sc = " . $id_DT . " and id_teacher = " . $user_id;
	$stmt_verify = $conn->query($query_verify);
	$dados_verify = $stmt_verify->fetch(PDO::FETCH_ASSOC);

	if($dados_verify){
		$result['status'] = 1;
		$result['title'] = $dados['title_activity'];
		$result['desc'] = $dados['desc_activity'];
		$result['create_at'] = $dados['created_at'];
	}
}

echo json_encode($result);
?>
