<?php 

	require('C:\xampp\htdocs\sistema\proj_esc_func\model\noticia.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\noticia_service.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\helpers\upload.php');

	$conexao = new Conexao();

		$noticia = new Noticia();

		if($acao == 'delete'){
			$id_ntc = $_GET['news_id'];
			$noticia->__set('id', $id_ntc);
			$noticia_service = new NoticiaService($conexao, $noticia);
			$noticia_service->delete();
		}
		
		$upload_img = upload_file(__DIR__."/../../uploads/atividades/","noticia" , $_FILES['img_file'], $_POST['titulo']);

		session_start();

		$user_id = $_SESSION['user_id'];

		$delimiter = "-";

		$noticia->__set('titulo', $_POST['titulo']);
		$noticia->__set('slug', strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $_POST['titulo']))))), $delimiter)));
		$noticia->__set('desc', $_POST['desc']);
		$noticia->__set('path', $upload_img);
		$noticia->__set('autor', $user_id);
		$noticia->__set('create_at', '');
		$noticia->__set('update_at', '');

		$noticia_service = new NoticiaService($conexao, $noticia);
		if ($acao == 'cad') {
			if($upload_img){
				$bool = $noticia_service->insert();
				echo json_encode($bool);
			}else{
				echo json_encode("<p class='msg msg-warn'>Falha ao enviar imagem para o servidor.</p>");	
			}
		}else if ($acao == 'edit') {
			$id_ntc = $_POST['id_ntc'];
			$noticia->__set('id', $id_ntc);
			$noticia_service = new NoticiaService($conexao, $noticia);
			$noticia_service->update();
		}

?>