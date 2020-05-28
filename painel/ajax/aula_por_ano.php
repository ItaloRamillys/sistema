<?php
$data = $_GET['data'];

require_once('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');

$conexao = new Conexao();

$conexao = $conexao->conectar();
$final = "";
if($data != ""){

	$query = "select h.nome_disc, k.nome_turma, k.ano, k.id_DT from disciplina h inner join (select x.*, t.nome_turma from turma t inner join (select distinct id_DT, ano, id_turma, id_disc from disc_turma where ano = '".$data."') x on t.id_turma = x.id_turma) k on k.id_disc = h.id_disc";

	$stmt = $conexao->query($query);

	$final = "<option value=''>Selecione a disciplina com a turma</option>";

	while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {

		$final .= "<option value='".$dados['id_DT']."'>".$dados['nome_disc']."-".$dados['nome_turma']."</option>";
		
	}
}else{
	$final = "<option>Selecione um ano</option>";
}

echo json_encode($final);
?>
