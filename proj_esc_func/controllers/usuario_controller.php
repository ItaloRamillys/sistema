<?php 
	require('C:\xampp\htdocs\sistema\proj_esc_func\model\usuario.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\usuario_service.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');

	$conexao = new Conexao();
	$usu = new Usuario();

	if($acao == 'delete'){
		$id_post = $_POST['id'];
		$usu->__set('id', $id_post);
		$usuario_service = new UsuarioService($conexao, $usu);
		echo json_encode($usuario_service->delete());
		exit;
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

	$usu->__set('login', 	  	strip_tags($_POST['login']));
	$usu->__set('senha',	  	strip_tags($_POST['senha']));
	$usu->__set('nome', 	  	strip_tags($_POST['nome']));
	$usu->__set('sobrenome',  	strip_tags($_POST['sobrenome']));
	$usu->__set('data_nasc',  	strip_tags($_POST['data_nasc']));
	$usu->__set('tipo_sangue',  strip_tags($_POST['tipo_sangue']));
	$usu->__set('genero',  		strip_tags($_POST['genero']));
	$usu->__set('rg', 		  	strip_tags($_POST['rg']));
	$usu->__set('cpf',        	strip_tags($_POST['cpf']));
	$usu->__set('end',        	strip_tags($_POST['end']));
	$usu->__set('email',      	strip_tags($email_end));
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
		$usu->__set('resp1', 	  strip_tags($_POST['resp_1']));
		$usu->__set('resp2', 	  strip_tags($_POST['resp_2']));
		$usu->__set('cont_resp1', strip_tags($_POST['cont_1']));
		$usu->__set('cont_resp2', strip_tags($_POST['cont_2']));
		$usu->__set('obs', 		  strip_tags($_POST['obs']));
		$usu->__set('alergia', 	  strip_tags($_POST['alergia']));
		$usu->__set('matricula',  strip_tags($_POST['matricula']));
	}else if($tipo == 'prof'){
		$usu->__set('salario', "");
		$usu->__set('vencimento', "");
		$usu->__set('descricao',"");
		$usu->__set('formacao',"");
		$usu->__set('tipo', 1);
		$usu->__set('salario', 	  strip_tags($_POST['salario']));
		$usu->__set('vencimento', 	  strip_tags($_POST['vencimento']));
		$usu->__set('descricao', strip_tags($_POST['descricao_prof']));
		$usu->__set('formacao', strip_tags($_POST['formacao']));
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