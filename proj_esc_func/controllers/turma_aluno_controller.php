<?php 

require('C:\xampp\htdocs\sistema\proj_esc_func\model\turma_aluno.php');
require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\turma_aluno_service.php');
require('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');

$conexao = new Conexao();

$turma_aluno = new TurmaAluno();

if($acao == 'delete'){
	$turma_aluno->__set('id_ta', stripcslashes($_GET['ta']));
	$turma_aluno->__set('id_turma', stripcslashes($_GET['turma_del']));
	$turma_aluno_service = new TurmaAlunoService($conexao, $turma_aluno);
	$turma_aluno_service->delete();
}
else if($acao == 'cad'){

	$alunos = $_POST['aluno_turma'];

	$turma = $_POST['turma'];

	$ano = $_POST['ano'];

	$turma_aluno->__set('ano', $ano);
	$turma_aluno->__set('id_turma', $turma);
	$turma_aluno->__set('id_aluno', $alunos);

	$aluno_turma_service = new TurmaAlunoService($conexao, $turma_aluno);
	$aluno_turma_service->insert();
	
}

?>