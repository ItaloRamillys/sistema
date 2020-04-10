<?php 

	require('C:\xampp\htdocs\sistema\proj_esc_func\model\turma.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\turma_service.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');

	$conexao = new Conexao();

	$turma = new Turma();


	$turma->__set('nome_turma', $_POST['nome_turma']);
	
	$turma_service = new TurmaService($conexao, $turma);
	
	$turma_service->insert();

?>