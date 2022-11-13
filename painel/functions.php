<?php
require_once(__DIR__.'\..\proj_esc_func\connection.php');

function getStringDate($date){
	$array_months = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
	$date = explode("-", $date);
	$string = $date[2] . " de " . $array_months[floor($date[1] - 1)] . " de " . $date[0];
	return $string;
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

function render_img($server_path_img, $relative_path_img, $path_img_aux, $id = null, $class = null, $width = null, $height = null){
	if(is_file($server_path_img)){
		return "<img src='{$relative_path_img}' class='{$class}' id='{$id}' width='{$width}' height='{$height}'>";
	}else{
		return "<img src='{$path_img_aux}' class='{$class}' id='{$id}' width='{$width}' height='{$height}'>";
	}
}

function sanitize_url_data($data){
	$data = filter_var($data, FILTER_SANITIZE_STRING);
	$data = htmlspecialchars($data);
	return $data;
}