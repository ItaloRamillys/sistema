<?php 

	require('C:\xampp\htdocs\sistema\proj_esc_func\model\news.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\news_service.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');

	$con = new Connection();

	$news = new News();

	if($operation == 'delete'){
		$id_news = $_GET['news_id'];
		$news->__set('id_news', $id_news);
		$news_service = new NewsService($con, $news);
		$news_service->delete();
	}

	$year = date("Y");
	$month = date("m");

	$dir_year = __DIR__ . "\\..\\..\\img\\news\\".$year;
	$dir_month = __DIR__ . "\\..\\..\\img\\news\\".$year."\\".$month;

	if(!is_dir($dir_year)){
		mkdir($dir_year, 0755);
		if(!is_dir($dir_month)){
			mkdir($dir_month, 0755);
		}
	}

	$uploaddir = $dir_month."\\";
	$name_file = $_FILES['img_file']['name'];
	$path_file = "news/".$year."/".$month."/".$_FILES['img_file']['name'];
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

	$news->__set('title', $_POST['title']);
	$news->__set('desc', $_POST['desc']);
	$news->__set('path', $path_file);
	$news->__set('author', $user_id);
	$news->__set('create_at', date("d/m/Y"));
	$news->__set('update_at', date("d/m/Y"));

	$news_service = new NewsService($con, $news);
	if ($operation == 'cad') {
		if($upload_img){
			$bool = $news_service->insert();
			echo json_encode($bool);
		}else{
			echo json_encode(false);	
		}
	}else if ($operation == 'edit') {
		$id_ntc = $_POST['id_ntc'];
		$news->__set('id', $id_ntc);
		$news_service = new newsService($conexao, $news);
		$news_service->update();
	}

?>