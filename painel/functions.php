<?php
require_once(__DIR__.'\..\proj_esc_func\connection.php');

function getMonthName(int $month){
	$array_meses = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
	return $array_meses[$month];
}

function getTextType(int $type){
	if($type == 0){
		return 'Aluno';
	}elseif($type == 1){
		return 'Professor';
	}elseif($type == 2){
		return 'Administrador';
	}else{
		return 'Tipo de usuário desconhecido';
	}
}

function is_adm($tipo){
	if($tipo == 2){
		return true;
	}
	return false;
}

function is_admin($user_name){
	$conn = new Connection();
	$conn = $conn->connect();
	$query_is_admin = "select type from user where login = '{$user_name}'"; 
	$stmt_is_admin  = $conn->query($query_is_admin);
	$row_is_admin   = $stmt_is_admin->fetch(PDO::FETCH_ASSOC);
	if($row_is_admin == 2){
		return true;
	}
	return false;
}

function render_img($server_path_img, $relative_path_img, $path_img_aux, $class = null, $width = null, $height = null){
	if(is_file($server_path_img)){
		return "<img src='{$relative_path_img}' class='{$class}' width='{$width}' height='{$height}'>";
	}else{
		return "<img src='{$path_img_aux}' class='{$class}' width='{$width}' height='{$height}'>";
	}
}

function sanitize_url_data($data){
	$data = filter_var($data, FILTER_SANITIZE_STRING);
	$data = htmlspecialchars($data);
	return $data;
}