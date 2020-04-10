<?php 

	require('C:\xampp\proj_esc_func\model\noticia.php');
	require('C:\xampp\proj_esc_func\controllers\noticia_service.php');
	require('C:\xampp\proj_esc_func\conexao.php');

	$conexao = new Conexao();

		$noticia = new Noticia();

		if($acao == 'delete'){
			$id_ntc = $_GET['news_id'];
			$noticia->__set('id', $id_ntc);
			$noticia_service = new NoticiaService($conexao, $noticia);
			$noticia_service->delete();
		}

		$uploaddir = '../img/noticia/';
		$name_file = $_FILES['img_file']['name'];
		$uploadfile = $uploaddir . $name_file;

		$allowedTypes = ['jpg', 'jpeg', 'png'];
		$typeFile = explode(".", $_FILES['img_file']['name']);

		if (isset($typeFile[1]) && !in_array($typeFile[1], $allowedTypes)) {
			return false;
		}

		if (basename($_FILES['img_file']['name']) == "") {
		    echo json_encode("Erro de nome");
			die;
		}

		$upload_img = false;

		if(move_uploaded_file($_FILES['img_file']['tmp_name'], $uploadfile)){
			$upload_img = true;
		}
		
		session_start();

		$user_id = $_SESSION['user_id'];

		$noticia->__set('titulo', $_POST['titulo']);
		$noticia->__set('desc', $_POST['desc']);
		$noticia->__set('path', $name_file);
		$noticia->__set('autor', $user_id);
		$noticia->__set('create_at', date("d/m/Y"));
		$noticia->__set('update_at', date("d/m/Y"));

		$noticia_service = new NoticiaService($conexao, $noticia);
		if ($acao == 'cad') {
			if($upload_img){
				$bool = $noticia_service->insert();
				echo json_encode($bool);
			}else{
				echo json_encode(false);	
			}
		}else if ($acao == 'edit') {
			$id_ntc = $_POST['id_ntc'];
			$noticia->__set('id', $id_ntc);
			$noticia_service = new NoticiaService($conexao, $noticia);
			$noticia_service->update();
		}

?>