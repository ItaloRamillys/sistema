<?php 

	require('C:\xampp\htdocs\sistema\proj_esc_func\model\usuario.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\usuario_service.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');

	$conexao = new Conexao();

	$usu = new Usuario();

	if($acao == 'delete'){
		$id_post = $_GET['user_id'];
		$usu->__set('id', $id_post);
		$usu->__set('tipo', $tipo);
		$usuario_service = new UsuarioService($conexao, $usu);
		$usuario_service->delete();
	}

	$ano = date("Y");
	$mes = date("m");

	$pastaAno = __DIR__ . "\\..\\..\\img\\usuario\\".$ano;
	$pastaMes = __DIR__ . "\\..\\..\\img\\usuario\\".$ano."\\".$mes;

	if(!is_dir($pastaAno)){
		mkdir($pastaAno, 0755);
		if(!is_dir($pastaMes)){
			mkdir($pastaMes, 0755);
		}
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

	$uploaddir = __DIR__ . '/../../img/usuario/'.$ano."/".$mes."/";

	$uploadfile = $uploaddir . $_FILES['img_profile']['name'];

	$allowedTypes = ['jpg', 'jpeg', 'png'];

	$typeFile = "";

	$typeFile = explode(".", $_FILES['img_profile']['name']);

	if (isset($typeFile[1]) && !in_array($typeFile[1], $allowedTypes)) {
		echo json_encode("Falha no tipo do arquivo");
		return null;
	}

	$img_bool = false;

	if(move_uploaded_file($_FILES['img_profile']['tmp_name'], $uploadfile)){
		$img_bool = true;
	}
		
	$usu->__set('img_profile', "usuario/".$ano."/".$mes."/" . $_FILES['img_profile']['name']);

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


	//operacao
	if ($acao == 'cad') {
		
		if ($img_bool) {
			$bool = $usuario_service->insert();
			echo json_encode($bool);
		}else{
			echo json_encode('Falha na imagem');
		}

	}else if($acao = 'edit'){
		$id_post = $_POST['id_user'];
		$usu->__set('id', $id_post);
		$usuario_service = new UsuarioService($conexao, $usu);
		$usuario_service->update();
	}else{
		echo json_encode("Nenhuma operação escolhida");
	}
?>