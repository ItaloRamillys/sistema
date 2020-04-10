<?php 

require('C:\xampp\htdocs\sistema\proj_esc_func\model\turma_disc.php');
require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\turma_disc_service.php');
require('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');

$conexao = new Conexao();

$turma_disc = new TurmaDisc();

if($acao == 'delete'){
	$turma_disc->__set('id_td', ($_GET['td']));
	$turma_aluno_service = new TurmaDiscService($conexao, $turma_disc);
	$turma_aluno_service->delete();
}
else if($acao == 'cad'){

	$id_disc = $_POST['disciplina'];

	$id_turma = $_POST['turma'];

	$id_prof = $_POST['professor'];

	$ano = $_POST['ano_turma'];

	$dia = $_POST['dia_sem'];

	$hora = $_POST['hora'];

	$turma_disc->__set('id_disc', $id_disc);
	$turma_disc->__set('id_turma', $id_turma);
	$turma_disc->__set('id_prof', $id_prof);
	$turma_disc->__set('ano', $ano);
	$turma_disc->__set('dia', $dia);
	$turma_disc->__set('hora', $hora);

	$turma_disc_service = new TurmaDiscService($conexao, $turma_disc);
	$turma_disc_service->insert();

}


?>