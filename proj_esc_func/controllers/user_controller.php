<?php 
	require('C:\xampp\htdocs\sistema\proj_esc_func\model\user.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\user_service.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');

	$connection = new Connection();
	$user = new User();

	if($acao == 'delete'){
		$id_post = $_POST['id'];
		$usu->__set('id', $id_post);
		$user_service = new userService($conexao, $usu);
		echo json_encode($user_service->delete());
		exit;
	}

	$year = date("Y");
	$month = date("m");

	$dirYear = __DIR__ . "\\..\\..\\img\\user\\".$year;
	$dirMonth = __DIR__ . "\\..\\..\\img\\user\\".$year."\\".$month;

	if(!is_dir($dirYear)){
		mkdir($dirYear, 0755);
		if(!is_dir($dirMonth)){
			mkdir($dirMonth, 0755);
		}
	}

	$email_user = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

	$usu->__set('first_name', 	  	trim(strip_tags($_POST['first_name'])));
	$usu->__set('last_name',	  	trim(strip_tags($_POST['last_name'])));
	$usu->__set('login', 	  		trim(strip_tags($_POST['login'])));
	$usu->__set('pass',  			trim(strip_tags($_POST['pass'])));
	$usu->__set('email',  			trim(strip_tags($_POST['email'])));
	$usu->__set('birth',  			trim(strip_tags($_POST['birth'])));
	$usu->__set('blood',  			trim(strip_tags($_POST['blood'])));
	$usu->__set('genre', 		  	trim(strip_tags($_POST['genre'])));
	$usu->__set('cpf',        		trim(strip_tags($_POST['cpf'])));
	$usu->__set('address',        	trim(strip_tags($_POST['address'])));
	$usu->__set('create_at',      	'');
	$usu->__set('update_at',    	'');

	$uploaddir = __DIR__ . '/../../img/user/'.$ano."/".$mes."/";

	$uploadfile = $uploaddir . $_FILES['img_profile']['name'];

	$allowedTypes = ['jpg', 'jpeg', 'png'];

	$typeFile = "";

	$typeFile = explode(".", $_FILES['img_profile']['name']);

	if (isset($typeFile[1]) && !in_array($typeFile[1], $allowedTypes)) {
		echo json_encode("Falha no type do arquivo");
		return null;
	}

	$img_bool = false;

	if(move_uploaded_file($_FILES['img_profile']['tmp_name'], $uploadfile)){
		$img_bool = true;
	}
		
	$usu->__set('img_profile', "user/".$ano."/".$mes."/" . $_FILES['img_profile']['name']);

	if($type == 'student'){
		$usu->__set('type', 0);
		$usu->__set('parent_1', "");
		$usu->__set('parent_2', "");
		$usu->__set('phone_parent_1',"");
		$usu->__set('phone_parent_2',"");
		$usu->__set('comments', "");
		$usu->__set('registration', "");
		$usu->__set('parent_1', 	  	strip_tags($_POST['parent_1']));
		$usu->__set('parent_2', 	  	strip_tags($_POST['parent_2']));
		$usu->__set('phone_parent_1', 	strip_tags($_POST['phone_parent_1']));
		$usu->__set('phone_parent_2', 	strip_tags($_POST['phone_parent_2']));
		$usu->__set('comments', 	  	strip_tags($_POST['comments']));
		$usu->__set('registration',  	strip_tags($_POST['registration']));
	}else if($type == 'teacher'){
		$usu->__set('salary', "");
		$usu->__set('validate', "");
		$usu->__set('description',"");
		$usu->__set('graduation',"");
		$usu->__set('type', 1);
		$usu->__set('salary', 	  strip_tags($_POST['salary']));
		$usu->__set('validate', 	  strip_tags($_POST['validate']));
		$usu->__set('description', strip_tags($_POST['description']));
		$usu->__set('graduation', strip_tags($_POST['graduation']));
	}else if($type == 'adm'){
		$usu->__set('type', 2);
	}

	$user_service = new UserService($conexao, $usu);

	if ($acao == 'insert') {
		if ($img_bool) {
			$bool = $user_service->insert();
			echo json_encode($bool);
		}else{
			echo json_encode('Não foi possivel enviar a imagem para o servidor. Verifique o tamanho e o formato.');
		}
	}else if($acao = 'edit'){
		$id_post = $_POST['id_user'];
		$usu->__set('id', $id_post);
		$user_service = new userService($conexao, $usu);
		$user_service->update();
	}else{
		echo json_encode("Nenhuma operação escolhida");
	}
?>