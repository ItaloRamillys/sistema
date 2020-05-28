<?php 

require('C:\xampp\htdocs\sistema\proj_esc_func\model\recorrencia_aula.php');
require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\recorrencia_aula__service.php');
require('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');

$conexao = new Conexao();

$rec_aula = new RecorrenciaAula();

if($acao == 'delete'){
	$rec_aula->__set('id_ta', stripcslashes($_GET['ta']));
	$rec_aula->__set('id_turma', stripcslashes($_GET['turma_del']));
	$rec_aula_service = new TurmaAlunoService($conexao, $rec_aula);
	$rec_aula_service->delete();
}
else if($acao == 'cad'){

	$dia_da_semana = $_POST['dia_da_semana'];
	$horario_de_inicio = $_POST['horario_de_inicio'];
	$horario_de_termino = $_POST['horario_de_termino'];
	$id_DT = $_POST['id_DT'];

	$rec_aula->__set('dia_da_semana', $dia_da_semana);
	$rec_aula->__set('horario_de_inicio', $horario_de_inicio);
	$rec_aula->__set('horario_de_termino', $horario_de_termino);
	$rec_aula->__set('id_DT', $id_DT);

	$rec_aula_service = new RecorrenciaAulaService($conexao, $rec_aula);
	json_encode($rec_aula_service->insert());	
}

?>