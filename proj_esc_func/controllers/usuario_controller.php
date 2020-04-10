<?php 

	require('C:\xampp\proj_esc_func\model\usuario.php');
	require('C:\xampp\proj_esc_func\controllers\usuario_service.php');
	require('C:\xampp\proj_esc_func\conexao.php');

	$conexao = new Conexao();

		$usu = new Usuario();

		if($acao == 'delete'){
			$id_post = $_GET['user_id'];
			$usu->__set('id', $id_post);
			$usu->__set('tipo', $tipo);
			$usuario_service = new UsuarioService($conexao, $usu);
			$usuario_service->delete();
		}

		$email_end = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

		$usu->__set('login', 	  	stripcslashes($_POST['login']));
		$usu->__set('senha',	  	stripcslashes($_POST['senha']));
		$usu->__set('nome', 	  	stripcslashes($_POST['nome']));
		$usu->__set('sobrenome',  	stripcslashes($_POST['sobrenome']));
		$usu->__set('data_nasc',  	stripcslashes($_POST['data_nasc']));
		$usu->__set('tipo_sangue',  stripcslashes($_POST['tipo_sangue']));
		$usu->__set('genero',  		stripcslashes($_POST['genero']));
		$usu->__set('rg', 		  	stripcslashes($_POST['rg']));
		$usu->__set('cpf',        	stripcslashes($_POST['cpf']));
		$usu->__set('end',        	stripcslashes($_POST['end']));
		$usu->__set('email',      	stripcslashes($email_end));
		$usu->__set('create_at',    '');
		$usu->__set('update_at',    '');

		$uploaddir = '../img/usuario/';
		$uploadfile = $uploaddir . $_FILES['img_profile']['name'];

		$allowedTypes = ['jpg', 'jpeg', 'png'];

		$typeFile = "";

		$typeFile = explode(".", $_FILES['img_profile']['name']);

		if (isset($typeFile[1]) && !in_array($typeFile[1], $allowedTypes)) {
			header('Location: ../../proj_esc/templates/cad_aluno.php?error_img=1');
		}

		move_uploaded_file($_FILES['img_profile']['tmp_name'], $uploadfile);
			

		$usu->__set('img_profile', $_FILES['img_profile']['name']);

		session_start();
		$usu->__set('id_esc', $_SESSION['escola']);

		if($tipo == 'aluno'){
			$usu->__set('resp1', "");
			$usu->__set('resp2', "");
			$usu->__set('cont_resp1',"");
			$usu->__set('cont_resp2',"");
			$usu->__set('obs', "");
			$usu->__set('matricula', "");
			$usu->__set('tipo', 0);
			$usu->__set('resp1', 	  stripcslashes($_POST['resp_1']));
			$usu->__set('resp2', 	  stripcslashes($_POST['resp_2']));
			$usu->__set('cont_resp1', stripcslashes($_POST['cont_1']));
			$usu->__set('cont_resp2', stripcslashes($_POST['cont_2']));
			$usu->__set('obs', 		  stripcslashes($_POST['obs']));
			$usu->__set('matricula',  stripcslashes($_POST['matricula']));
		}else if($tipo == 'prof'){
			$usu->__set('salario', "");
			$usu->__set('vencimento', "");
			$usu->__set('descricao',"");
			$usu->__set('formacao',"");
			$usu->__set('tipo', 1);
			$usu->__set('salario', 	  stripcslashes($_POST['salario']));
			$usu->__set('vencimento', 	  stripcslashes($_POST['vencimento']));
			$usu->__set('descricao', stripcslashes($_POST['descricao_prof']));
			$usu->__set('formacao', stripcslashes($_POST['formacao']));
		}else if($tipo == 'adm'){
			$usu->__set('tipo', 2);
		}

		$usuario_service = new UsuarioService($conexao, $usu);

		if ($acao == 'cad') {
			
			$bool = $usuario_service->insert();
			echo json_encode($bool);

		}else if($acao = 'edit'){
			$id_post = $_POST['id_user'];
			$usu->__set('id', $id_post);
			$usuario_service = new UsuarioService($conexao, $usu);
			$usuario_service->update();
		}else{
			header("Location: ../../proj_esc/index.php");
		}
?>