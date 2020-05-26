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
	}
	if(!is_dir($pastaMes)){
		mkdir($pastaMes, 0755);
	}

	$email_end = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

	$usu->__set('login', 	  	strip_tags($_POST['login']));
	$usu->__set('senha',	  	strip_tags($_POST['senha']));
	$usu->__set('nome', 	  	strip_tags($_POST['nome']));
	$usu->__set('sobrenome',  	strip_tags($_POST['sobrenome']));
	$usu->__set('data_nasc',  	strip_tags($_POST['data_nasc']));
	$usu->__set('tipo_sangue',  strip_tags($_POST['tipo_sangue']));
	$usu->__set('genero',  		strip_tags($_POST['genero']));
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

	//TESTE TIPO DA IMAGEM
	if (isset($typeFile[1]) && !in_array($typeFile[1], $allowedTypes)) {
		echo json_encode("Falha no tipo do arquivo");
		return null;
	}

	$img_bool = false;

	//IMAGENS REPETIDAS
	if (is_file($uploadfile)) {
		$name_img_final = $typeFile[0]."-".date('Y-m-d')."-".hash('crc32',$_POST['login']).".".$typeFile[1];
	}else{
		$name_img_final = $name_image;
	}

	$uploadfile = $uploaddir . $name_img_final;

	//TESTE UPLOAD DA IMAGEM
	if(move_uploaded_file($_FILES['img_profile']['tmp_name'], $uploadfile)){
		$img_bool = true;
	}
		
	$usu->__set('img_profile', "usuario/".$ano."/".$mes."/" . $name_img_final);

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
		
		if ($img_bool) {
			echo json_encode($usuario_service->insert());
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