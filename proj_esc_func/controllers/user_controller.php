<?php 
	session_start();

	require("autoload.php");
	use Helpers\Text;
	
	require('C:\xampp\htdocs\sistema\proj_esc_func\model\user.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\user_service.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\helpers\upload.php');

	$txt = new Text();
	$conn = new Connection();
	$user = new User();

	$_SESSION['count_operations_db'] = $_SESSION['count_operations_db'] + 1;

	$id_resp = $_SESSION['user_id'];

	if($action == 'edit'){
		if($_SESSION['type'] == 2){
			if($_POST['name']){
				$name = $txt->only_alpha($_POST['name']);
				$user->__set('name', 	  	strip_tags(trim($name)));
			}
			if($_POST['last_name']){
				$last_name = $txt->only_alpha($_POST['last_name']);
				$user->__set('last_name', 	  	strip_tags(trim($last_name)));
			}
			if($_POST['birth']){
				$user->__set('birth',  	strip_tags(trim($_POST['birth'])));
			}
			if($_POST['blood']){
				$user->__set('blood',  strip_tags(trim($_POST['blood'])));
			}
			if($_POST['genre']){
				$user->__set('genre',  		strip_tags(trim($_POST['genre'])));
			}
			if($_POST['document']){
				$user->__set('document',        	strip_tags(trim($_POST['document'])));
			}
			if($_POST['address']){
				$user->__set('address',     strip_tags(trim($_POST['address'])));
			}
			if($_POST['email']){
				$user->__set('email',      	strip_tags(trim($_POST['email'])));
			}
		}

		$id_user = $_POST['id_user'];

		if($id_resp == $id_user){
			if(!is_null($_POST['login'])){
				$user->__set('login', 	  	strip_tags(trim($_POST['login'])));
			}
			if(!is_null($_POST['pass'])){
				$user->__set('pass',	  	strip_tags(trim($_POST['pass'])));
			}
			if(isset($_FILES['img_profile'])){
				$imagem = upload_image(__DIR__."/../../img/","usuario" , $_FILES['img_profile'], $_POST['login']);
				if($imagem['result']){
					$user->__set('img_profile', $imagem['expected_return']);
				}else{
					echo json_encode("<p class='msg msg-error'>".$imagem['msg_return']."</p>");
					exit;
				}
			}
		}else{
			if(isset($_FILES['img_profile'])){
				$imagem = upload_image(__DIR__."/../../img/", "usuario" , $_FILES['img_profile'], strip_tags(trim($_POST['name'])));
				if($imagem['result']){
					$user->__set('img_profile', $imagem['expected_return']);
				}else{
					echo json_encode("<p class='msg msg-error'>".$imagem['msg_return']."</p>");
					exit;
				}
			}
		}
		
		/*RESTRIÇÃO DE EDIÇAO VIA ADM*/
		
		$user->__set('id_author_update', $id_resp);
		$user->__set('id', $id_user);
		$user_service = new UserService($conn, $user);
		echo json_encode($user_service->update());
	}

	else if($action == 'style'){
		$num = $txt->only_number($_POST['std_style']);
		$user->__set('std_style', $num);
		$user_service = new UserService($conn, $user);
		echo json_encode($user_service->change_style());
	}

	else{

		
		if($_SESSION['type'] == 2){

			if($action == 'delete'){
				$id_post = $_POST['id'];
				$email   = $_POST['email']; 
				$user->__set('id', $id_post);
				$user->__set('email', $email);
				$user_service = new UserService($conn, $user);
				echo json_encode($user_service->delete());
			}

			elseif($action == 'reactivate'){
				$id_post = $_POST['id'];
				$email   = $_POST['email']; 
				$user->__set('id', $id_post);
				$user->__set('email', $email);
				$user_service = new UserService($conn, $user);
				echo json_encode($user_service->reactivate());		
			}

			elseif($action == 'disable'){
				$id_post = $_POST['id'];
				$email   = $_POST['email']; 
				$user->__set('id', $id_post);
				$user->__set('email', $email);
				$user_service = new UserService($conn, $user);
				echo json_encode($user_service->disable());		
			}

			elseif ($action == 'cad') {
				if($type == 'student'){
					$user->__set('type', 0);
				}else if($type == 'teacher'){
					$user->__set('type', 1);
				}else if($type == 'adm'){
					$user->__set('type', 2);
				}

				if($_POST['name']){
					$name = $txt->only_alpha($_POST['name']);
					$user->__set('name', 	  	strip_tags(trim($name)));
				}
				if($_POST['last_name']){
					$last_name = $txt->only_alpha($_POST['last_name']);
					$user->__set('last_name', 	  	strip_tags(trim($last_name)));
				}
				if($_POST['birth']){
					$user->__set('birth',  	strip_tags(trim($_POST['birth'])));
				}
				if($_POST['blood']){
					$user->__set('blood',  strip_tags(trim($_POST['blood'])));
				}
				if($_POST['genre']){
					$user->__set('genre',  		strip_tags(trim($_POST['genre'])));
				}
				if($_POST['document']){
					$user->__set('document',        	strip_tags(trim($_POST['document'])));
				}
				if($_POST['address']){
					$user->__set('address',     strip_tags(trim($_POST['address'])));
				}
				if($_POST['email']){
					$email_end = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
					$user->__set('email',      	strip_tags(trim($email_end)));
				}

				$user->__set('login', 	  	strip_tags(trim($_POST['login'])));
				$user->__set('pass',	  	strip_tags(trim($_POST['pass'])));
				
				$user->__set('id_author_insert', $_SESSION['user_id']);
				$user->__set('status', 1);
				
				if(isset($_FILES['img_profile'])){
					$imagem = upload_image(__DIR__."/../../img/","usuario" , $_FILES['img_profile'], $_POST['login']);
					if($imagem['result']){
						$user->__set('img_profile', $imagem['expected_return']);
					}else{
						echo json_encode("<p class='msg msg-error'>".$imagem['msg_return']."</p>");
						exit;
					}
				}

				$user_service = new UserService($conn, $user);
				echo json_encode($user_service->insert());
				
			}
		}
	}
?>