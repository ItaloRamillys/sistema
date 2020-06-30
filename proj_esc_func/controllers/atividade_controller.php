<?php 
	session_start();
	require('C:\xampp\htdocs\sistema\proj_esc_func\model\atividade.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\atividade_service.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\helpers\upload.php');

	$conexao = new Conexao();

	$atividade = new Atividade();	

	if(!empty($_FILES['arquivo-atividade'])){
    	$file = upload_file(__DIR__."/../../uploads/atividades/", "", $_FILES['arquivo-atividade'], $_POST['titulo-atividade'], ['pdf']);
    }

    if($_SESSION['tipo'] == 1){
    	if (isset($_POST)) {
			$atividade->__set('titulo', strip_tags(trim($_POST['titulo-atividade'])));
			$atividade->__set('descricao', strip_tags(trim($_POST['descricao-atividade'])));
			$atividade->__set('referencias', strip_tags(trim($_POST['referencia-atividade'])));
			$atividade->__set('id_DT', strip_tags(trim($_POST['id_DT'])));
			$atividade->__set('id_resp', strip_tags($_SESSION['user_id']));
			
			if(isset($file)){
				$atividade->__set('arquivo', $file);
			}

			$atividade_service = new AtividadeService($conexao, $atividade);
		}else{
			echo json_encode("<p class='msg msg-warn'>A requisição foi recusada</p>");
		}
    	if($acao == "edit"){	
			$bool = $atividade_service->edit();
			echo json_encode($bool);
    	}elseif($acao == "cad"){
			$bool = $atividade_service->insert();
			echo json_encode($bool);
    	}
    }

	
?>