<?php 
	require('C:\xampp\htdocs\sistema\proj_esc_func\model\disciplina.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\disc_service.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');

	$conexao = new Conexao();

	$disciplina = new Disciplina();

	$cod = $_POST['cod_disc'] ? $_POST['cod_disc'] : NULL;
	$nome = $_POST['nome_disc'] ? $_POST['nome_disc'] : NULL;

	$disciplina->__set('nome_disc', $nome);
	$disciplina->__set('cod_disc', $cod);

	$disciplina_service = new DisciplinaService($conexao, $disciplina);

	echo json_encode($disciplina_service->insert());
?>