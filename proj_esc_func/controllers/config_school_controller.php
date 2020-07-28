<?php 
	session_start();
	require('C:\xampp\htdocs\sistema\proj_esc_func\model\config_school.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\config_school_service.php');
	require('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');

	$conn  = new Connection();
	$connected = $conn->connect();
	$config_school = new ConfigSchool();

	$query_verify = "select count(*) from config_school";
	$stmt_verify = $connected->query($query_verify);
	$row_verify = $stmt_verify->fetchColumn();


	$avg_grade = $_POST['avg_grade'];
	$max_missing = $_POST['max_missing'];
	$missing_allowance = $_POST['missing_allowance'];
	$id_adm = $_SESSION['user_id'];

	$config_school->__set('avg_grade', $avg_grade);
	$config_school->__set('max_missing', $max_missing);
	$config_school->__set('missing_allowance', $missing_allowance);

	if($row_verify == 0){
		$config_school->__set('id_adm_insert', $id_adm);
		$config_school_service = new ConfigSchoolService($conn, $config_school);
		echo json_encode($config_school_service->insert());
	}else{
		$config_school->__set('id_adm_update', $id_adm);
		$config_school_service = new ConfigSchoolService($conn, $config_school);
		echo json_encode($config_school_service->update());
	}
?>