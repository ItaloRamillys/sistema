<?php 
	require('C:\xampp\htdocs\sistema\proj_esc_func\model\news.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\news_service.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\helpers\upload.php');

	$conn = new Connection();

	$news = new News();

	if($action == 'delete'){
		$id_ntc = $_GET['news_id'];
		$news->__set('id', $id_ntc);
		$news_service = new NewsService($conn, $news);
		$news_service->delete();
	}
	
	$dimensions = [[100,100], [200,200], [720, 480]];

	if(!empty($_FILES['img_news'])){
		$upload_img = upload_image(__DIR__."/../../img/", "noticia" , $_FILES['img_news'], $_POST['title_news'], $dimensions);
		$news->__set('img_news', $upload_img);
	}else{
		$upload_img = '';
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
		if($upload_img){
			$bool = $news_service->insert();
			echo json_encode($bool);
		}else{
			echo json_encode("<p class='msg msg-warn'>Falha ao enviar imagem para o servidor.<i class='fas fa-times-circle icon-close'></i></p>");	
		}
	}else if ($action == 'edit') {
		$id_news = $_POST['id_news'];
		$news->__set('id_news', $id_news);
		$news_service = new NewsService($conn, $news);
		$bool = $news_service->update();
		echo json_encode($bool);
	}

?>