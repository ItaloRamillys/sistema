<?php 
	require('C:\xampp\htdocs\sistema\proj_esc_func\model\news.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\news_service.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\helpers\upload.php');

	$conn = new Connection();
	$news = new News();

	if($action == 'delete'){
		$id_news = $_POST['id_news'];
		$slug_news = $_POST['slug_news'];
		$news->__set('id_news', $id_news);
		$news->__set('slug_news', $slug_news);
		$news_service = new NewsService($conn, $news);
		$bool = $news_service->delete();
		echo json_encode($bool);	
		exit;
	}

	if(!empty($_FILES['img_news'])){
		$imagem = upload_image(__DIR__."/../../img/","noticia" , $_FILES['img_news'], $_POST['title_news'], true);
		if($imagem['result']){
			$news->__set('img_news', $imagem['expected_return']);
			$upload_img = 1;
		}else{
			echo json_encode("<p class='msg msg-error'>".$imagem['msg_return']."</p>");
			exit;
		}
	}else{
		$news->__set('img_news', '');
	}
	
	session_start();
	$user_id = $_SESSION['user_id'];
	$delimiter = "-";
	$news->__set('title_news', $_POST['title_news']);
	$news->__set('slug_news', strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $_POST['title_news']))))), $delimiter)));
	$news->__set('desc_news', $_POST['desc_news']);
	$news->__set('author_news', $user_id);
	$news_service = new NewsService($conn, $news);
	if ($action == 'cad') {
		$bool = $news_service->insert();
		echo json_encode($bool);
	}else if ($action == 'edit') {
		$id_news = $_POST['id_news'];
		$news->__set('id_news', $id_news);
		$news_service = new NewsService($conn, $news);
		$bool = $news_service->update();
		echo json_encode($bool);
	}

?>