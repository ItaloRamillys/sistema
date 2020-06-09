<?php 
	require('C:\xampp\htdocs\sistema\proj_esc_func\model\atividade.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\atividade_service.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\helpers\upload.php');

	$conexao = new Conexao();

	$atividade = new Atividade();	

    $file = upload_file(__DIR__."/../../uploads/atividades/", "", $_FILES['arquivo-atividade'], $_POST['titulo-atividade'], ['pdf']);

	if (isset($_POST) && $file) {
		session_start();
		$atividade->__set('titulo', trim($_POST['titulo-atividade']));
		$atividade->__set('descricao', trim($_POST['descricao-atividade']));
		$atividade->__set('referencias', trim($_POST['referencia-atividade']));
		$atividade->__set('id_DT', trim($_POST['id_DT']));
		$atividade->__set('id_resp', $_SESSION['user_id']);
		$atividade->__set('arquivo', $file);

		$atividade_service = new AtividadeService($conexao, $atividade);
		
		$bool = $atividade_service->insert();
		echo json_encode($bool);
	}
?>