<?php 

	require('C:\xampp\htdocs\sistema\proj_esc_func\model\atividade.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\atividade_service.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');

	$conexao = new Conexao();

	$atividade = new Atividade();	

	$uploaddir = '../img/atividade/';

	$file_atv = "";

	$allowedTypes = ['pdf'];

	$typeFile = "";

	$typeFile = explode(".", $_FILES['file_atv']['name']);

	if(!empty($_FILES['img_atv'])){
		$file_atv = basename($_FILES['img_esc']['name']);
	}
	
	if (!isset($typeFile[1]) || isset($typeFile[1]) && !in_array($typeFile[1], $allowedTypes)) {
		header('Location: ../../proj_esc/templates/cad_aluno.php?error=1');
	}


	if($file_atv != "") {
		$uploadfile_esc = $uploaddir . basename($_FILES['img_esc']['name']);
		move_uploaded_file($_FILES['img_esc']['tmp_name'], $uploadfile_esc);
		$atividade->__set('img_esc', $file_esc);
    }else{
    	$atividade->__set('img_esc', "");
    }

	if (isset($_POST)) {

		$atividade->__set('titulo', trim($_POST['titulo']));
		$atividade->__set('descricao', trim($_POST['descricao']));
		$atividade->__set('referencias', trim($_POST['referencias']));

		$atividade_service = new AtividadeService($conexao, $atividade);
		
		$bool = $atividade_service->update();
		echo json_encode($bool);
	}

		

?>