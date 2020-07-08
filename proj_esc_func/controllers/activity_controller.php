<?php 
	session_start();
	require('C:\xampp\htdocs\sistema\proj_esc_func\model\activity.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\activity_service.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\helpers\upload.php');

	$conn = new Connection();
	$activity = new Activity();	

	if(!empty($_FILES['file-activity'])){
    	$file = upload_file(__DIR__."/../../uploads/atividade/", "", $_FILES['file-activity'], $_POST['title-activity'], ['pdf']);
    }

    if($_SESSION['type'] == 1){
    	if (isset($_POST)) {
			$activity->__set('title_activity', strip_tags(trim($_POST['title-activity'])));
			$activity->__set('desc_activity', strip_tags(trim($_POST['desc-activity'])));
			$activity->__set('references_activity', strip_tags(trim($_POST['reference-activity'])));
			$activity->__set('id_author', strip_tags(trim($_POST['id_SC'])));
			$activity->__set('id_SC', strip_tags($_SESSION['user_id']));
			
			if(isset($file)){
				$activity->__set('file_activity', $file);
			}

			$activity_service = new ActivityService($conn, $activity);
		}else{
			echo json_encode("<p class='msg msg-warn'>A requisição foi recusada</p>");
		}
    	if($action == "edit"){	
			$bool = $activity_service->edit();
			echo json_encode($bool);
    	}elseif($action == "insert"){
			$bool = $activity_service->insert();
			echo json_encode($bool);
    	}
    }

	
?>