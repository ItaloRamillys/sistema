<?php 
	require('C:\xampp\htdocs\sistema\proj_esc_func\model\usuario.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\usuario_service.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\helpers\upload.php');

	$conexao = new Conexao();
	$usu = new Usuario();

	if($acao == 'delete'){
		$id_post = $_POST['id'];
		$usu->__set('id', $id_post);
		$usu->__set('tipo', $tipo);
		$usuario_service = new UsuarioService($conexao, $usu);
		echo json_encode($usuario_service->delete());
		exit;
	}

	$email_end = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

	$usu->__set('login', 	  	strip_tags(trim($_POST['login'])));
	$usu->__set('senha',	  	strip_tags(trim($_POST['senha'])));
	$usu->__set('nome', 	  	strip_tags(trim($_POST['nome'])));
	$usu->__set('sobrenome',  	strip_tags(trim($_POST['sobrenome'])));
	$usu->__set('data_nasc',  	strip_tags(trim($_POST['data_nasc'])));
	$usu->__set('tipo_sangue',  strip_tags(trim($_POST['tipo_sangue'])));
	$usu->__set('genero',  		strip_tags(trim($_POST['genero'])));
	$usu->__set('cpf',        	strip_tags(trim($_POST['cpf'])));
	$usu->__set('end',        	strip_tags(trim($_POST['end'])));
	$usu->__set('email',      	strip_tags(trim($email_end)));
	$usu->__set('create_at',    '');
	$usu->__set('update_at',    '');

	$imagem = upload_file(__DIR__."/../../img/", "usuario", $_FILES['img_profile'], $_POST['login'], null);

	$usu->__set('img_profile', $imagem);

	if($tipo == 'aluno'){
		$usu->__set('tipo', 0);
		
	}else if($tipo == 'prof'){
		
		$usu->__set('tipo', 1);
		
	}else if($tipo == 'adm'){
		$usu->__set('tipo', 2);
	}

	$usuario_service = new UsuarioService($conexao, $usu);

	//operacao
	if ($acao == 'cad') {
		
		if ($imagem) {
			echo json_encode($usuario_service->insert());
		}else{
			echo json_encode('Falha na imagem');
		}

	}else if($acao = 'edit'){
		session_start();
		$id_post = $_SESSION['user_id'];
		$usu->__set('id', $id_post);
		$usuario_service = new UsuarioService($conexao, $usu);
		$usuario_service->update();
	}else{
		echo json_encode("Nenhuma operação escolhida");
	}
?>