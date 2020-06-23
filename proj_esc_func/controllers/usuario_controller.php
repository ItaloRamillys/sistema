<?php 
	session_start();
	require('C:\xampp\htdocs\sistema\proj_esc_func\model\usuario.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\usuario_service.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\helpers\upload.php');

	$conexao = new Conexao();
	$usu = new Usuario();

	$dimensions = [[50,50], [100,100], [200,200]];

	if($tipo == 'aluno'){
		$usu->__set('tipo', 0);
	}else if($tipo == 'prof'){
		$usu->__set('tipo', 1);
	}else if($tipo == 'adm'){
		$usu->__set('tipo', 2);
	}
	
	if($acao = 'edit'){

		if($_SESSION['tipo'] == 2){
			if($_POST['nome']){
				$usu->__set('nome', 	  	strip_tags(trim($_POST['nome'])));
			}
			if($_POST['sobrenome']){
				$usu->__set('sobrenome',  	strip_tags(trim($_POST['sobrenome'])));
			}
			if($_POST['data_nasc']){
				$usu->__set('data_nasc',  	strip_tags(trim($_POST['data_nasc'])));
			}
			if($_POST['tipo_sangue']){
				$usu->__set('tipo_sangue',  strip_tags(trim($_POST['tipo_sangue'])));
			}
			if($_POST['genero']){
				$usu->__set('genero',  		strip_tags(trim($_POST['genero'])));
			}
			if($_POST['cpf']){
				$usu->__set('cpf',        	strip_tags(trim($_POST['cpf'])));
			}
			if($_POST['endereco']){
				$usu->__set('endereco',     strip_tags(trim($_POST['endereco'])));
			}
			if($_POST['email']){
				$usu->__set('email',      	strip_tags(trim($_POST['email'])));
			}
		}

		$id_user = $_POST['id_user'];
		$id_resp = $_SESSION['user_id'];

		if($id_resp == $id_user){
			if(!is_null($_POST['login'])){
				$usu->__set('login', 	  	strip_tags(trim($_POST['login'])));
			}
			if(!is_null($_POST['senha'])){
				$usu->__set('senha',	  	strip_tags(trim($_POST['senha'])));
			}
			if(isset($_FILES['img_profile'])){
				$imagem = upload_image(__DIR__."/../../img/","usuario" , $_FILES['img_profile'], $_POST['login'], $dimensions);
				$usu->__set('img_profile', $imagem);
			}
		}
		
		$usu->__set('id_resp_update', $id_resp);
		$usu->__set('id', $id_user);
		$usuario_service = new UsuarioService($conexao, $usu);
		echo json_encode($usuario_service->update());
	}

	elseif($_SESSION['tipo'] == 2){

		if($acao == 'delete'){
			$id_post = $_POST['id'];
			$email   = $_POST['email']; 
			$usu->__set('id', $id_post);
			$usu->__set('email', $email);
			$usuario_service = new UsuarioService($conexao, $usu);
			echo json_encode($usuario_service->delete());
		}

		if($acao == 'reactivate'){
			$id_post = $_POST['id'];
			$email   = $_POST['email']; 
			$usu->__set('id', $id_post);
			$usu->__set('email', $email);
			$usuario_service = new UsuarioService($conexao, $usu);
			echo json_encode($usuario_service->reactivate());		
		}

		if ($acao == 'cad') {
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
			$usu->__set('id_resp_insert', $_SESSION['tipo']);
			$usu->__set('email',      	strip_tags(trim($email_end)));
			
			if(isset($_FILES['img_profile'])){
				$imagem = upload_image(__DIR__."/../../img/","noticia" , $_FILES['img_file'], $_POST['titulo'], $dimensions);
				$usu->__set('img_profile', $imagem);
			}

			$usuario_service = new UsuarioService($conexao, $usu);
			
			if ($imagem) {
				echo json_encode($usuario_service->insert());
			}else{
				echo json_encode('Falha na imagem');
			}
		}
	}
	else{
		echo json_encode("<p class='msg msg-warn'>Apenas um administrador logado pode efetuar este tipo de operação</p>");
	}
	
?>