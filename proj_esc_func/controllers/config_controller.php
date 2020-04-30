<?php 

	require('C:\xampp\htdocs\sistema\proj_esc_func\model\config.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\config_service.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');

	$conexao = new Conexao();

		$config = new Configuracao();

		$uploaddir = '../img/sistema/';

		$file_esc = $file1 = $file2 = $file3 = "";

		if(!empty($_FILES['img_esc'])){
			$file_esc = basename($_FILES['img_esc']['name']);
		}
		if(!empty($_FILES['img1'])){
			$file1 = basename($_FILES['img1']['name']);
		}
		if(!empty($_FILES['img2'])){
			$file2 = basename($_FILES['img2']['name']);
		}
		if(!empty($_FILES['img3'])){
			$file3 = basename($_FILES['img3']['name']);
		}

		if($file_esc!="") {
			$uploadfile_esc = $uploaddir . basename($_FILES['img_esc']['name']);
			move_uploaded_file($_FILES['img_esc']['tmp_name'], $uploadfile_esc);
			$config->__set('img_esc', $file_esc);
	    }else{
	    	$config->__set('img_esc', "");
	    }

	    if($file1!="") {
			$uploadfile1 = $uploaddir . basename($_FILES['img1']['name']);
			move_uploaded_file($_FILES['img1']['tmp_name'], $uploadfile1);
			$config->__set('img1', "sistema/" . $file1);
	    }else{
	    	$config->__set('img1', "");
	    }

	    if($file2!="") {
			$uploadfile2 = $uploaddir . basename($_FILES['img2']['name']);
			move_uploaded_file($_FILES['img2']['tmp_name'], $uploadfile2);
			$config->__set('img2', "sistema/" . $file2);
	    }else{
	    	$config->__set('img2', "");
	    }

	    if($file3!="") {
			$uploadfile3 = $uploaddir . basename($_FILES['img3']['name']);
			move_uploaded_file($_FILES['img3']['tmp_name'], $uploadfile3);
			$config->__set('img3', "sistema/" . $file3);
	    }else{
	    	$config->__set('img3', "");
	    }

		if (isset($_POST)) {

			$config->__set('txt_img1', trim($_POST['txt_img1']));
			$config->__set('txt_img2', trim($_POST['txt_img2']));
			$config->__set('txt_img3', trim($_POST['txt_img3']));

		    $config->__set('titulo', $_POST['titulo']);
			$config->__set('contato', $_POST['contato']);
			$config->__set('local', $_POST['local']);
			$config->__set('desc_esc', $_POST['desc_esc']);

			$config_service = new ConfigService($conexao, $config);
			
			$bool = $config_service->update();
			echo json_encode($bool);
		} else {
			echo "<script> alert('Possivel erro de upload nas imagens'); </script>";
			echo "<script> window.location='../../proj_esc/templates/config_site.php?cadastro=2';</script>";
		}


		

?>