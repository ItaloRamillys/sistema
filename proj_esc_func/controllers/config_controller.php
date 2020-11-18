<?php 
	require('C:\xampp\htdocs\sistema\proj_esc_func\model\config.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\config_service.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');

	$connection = new Connection();

	$config = new Config();

	$uploaddir = '../img/sistema/';

	$file_school = $file1 = $file2 = $file3 = "";

	if(!empty($_FILES['img_school'])){
		$file_school = basename($_FILES['img_school']['name']);
	}
	if(!empty($_FILES['img_featured_1'])){
		$file1 = basename($_FILES['img_featured_1']['name']);
	}
	if(!empty($_FILES['img_featured_2'])){
		$file2 = basename($_FILES['img_featured_2']['name']);
	}
	if(!empty($_FILES['img_featured_3'])){
		$file3 = basename($_FILES['img_featured_3']['name']);
	}

	if($file_school!=""){
		$uploadfile_school = $uploaddir . basename($_FILES['img_school']['name']);
		move_uploaded_file($_FILES['img_school']['tmp_name'], $uploadfile_school);
		$config->__set('img_school', "sistema/".$file_school);
    }else{
    	$config->__set('img_school', "");
    }

    if($file1!="") {
		$uploadfile1 = $uploaddir . basename($_FILES['img_featured_1']['name']);
		move_uploaded_file($_FILES['img_featured_1']['tmp_name'], $uploadfile1);
		$config->__set('img_featured_1', "sistema/" . $file1);
    }else{
    	$config->__set('img_featured_1', "");
    }

    if($file2!="") {
		$uploadfile2 = $uploaddir . basename($_FILES['img_featured_2']['name']);
		move_uploaded_file($_FILES['img_featured_2']['tmp_name'], $uploadfile2);
		$config->__set('img_featured_2', "sistema/" . $file2);
    }else{
    	$config->__set('img_featured_2', "");
    }

    if($file3!="") {
		$uploadfile3 = $uploaddir . basename($_FILES['img_featured_3']['name']);
		move_uploaded_file($_FILES['img_featured_3']['tmp_name'], $uploadfile3);
		$config->__set('img_featured_3', "sistema/" . $file3);
    }else{
    	$config->__set('img_featured_3', "");
    }

	if (isset($_POST)) {
		$config->__set('txt_img_featured_1', trim($_POST['txt_img_featured_1']));
		$config->__set('txt_img_featured_2', trim($_POST['txt_img_featured_2']));
		$config->__set('txt_img_featured_3', trim($_POST['txt_img_featured_3']));

	    $config->__set('title_site', $_POST['title_site']);
		$config->__set('phone_school_1', $_POST['phone_school_1']);
		$config->__set('phone_school_2', $_POST['phone_school_2']);
		$config->__set('phone_school_3', $_POST['phone_school_3']);
		//$config->__set('img_local', $_POST['img_local']);
		$config->__set('desc_school', $_POST['desc_school']);

		$config->__set('style', $_POST['style']);

		$config_service = new ConfigService($connection, $config);
		
		$bool = $config_service->update();
		echo json_encode($bool);
	} else {
		echo "<script> alert('Possivel erro de upload nas imagens'); </script>";
	}


	

?>