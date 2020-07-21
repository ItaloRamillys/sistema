<?php
require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\autoload.php');
use Helpers\Image;

//Função que move a arquivo para o servidor e retorna o caminha da imagem absoluta
function upload_file($dir, $model = null, $file, $hash){

	$model = $model;
	
	$year  = date("Y");
	$month = date("m");

	$start_path = $dir;

	$year_dir  = $start_path . $model . "/" . $year;
	$month_dir = $start_path . $model . "/" . $year."/".$month;

	if(!is_null($model)){
		$model .= "/";
	}

	if(!is_dir($year_dir)){
		mkdir($year_dir, 0755);
	}
	if(!is_dir($month_dir)){
		mkdir($month_dir, 0755);
	}

	$typeFile = "";

	$typeFile = explode(".", $file['name']);
	$uploadfile = $month_dir . "/" . $file['name'];

	if (is_file($uploadfile)) {
		$name_img_final = $typeFile[0].date('-YmdHis-').hash('crc32',$hash).".".$typeFile[1];
	}else{
		$name_img_final = $file['name'];
	}

	$uploadfile = $month_dir . "/" . $name_img_final;

	if(move_uploaded_file($file['tmp_name'], $uploadfile)){
		return $model . $year."/".$month."/".$name_img_final;
	}
	return false;
}

//Função que move a imagem para o servidor, redimensiona de acordo com o array $dimensions e retorna o caminha da imagem absoluta
function upload_image($dir, $model = null, $file, $hash){

	$model = $model;
	
	$year  = date("Y");
	$month = date("m");

	$start_path = $dir;

	$year_dir  = $start_path . $model . "/" . $year;
	$month_dir = $start_path . $model . "/" . $year."/".$month;

	if(!is_null($model)){
		$model .= "/";
	}

	if(!is_dir($year_dir)){
		mkdir($year_dir, 0755);
	}
	if(!is_dir($month_dir)){
		mkdir($month_dir, 0755);
	}

	$typeFile = "";
	$typeFile = explode(".", $file['name']);
	$uploadfile = $month_dir . "/" . $file['name'];

	if (is_file($uploadfile)) {
		$name_img_final = $typeFile[0].date('-YmdHis-').hash('crc32',$hash).".".$typeFile[1];
	}else{
		$name_img_final = $file['name'];
	}

	$uploadfile = $month_dir . "/" . $name_img_final;

	$img_resized = false;

	if(move_uploaded_file($file['tmp_name'], $uploadfile)){		
		return $model . $year."/".$month."/".$name_img_final;
	}
		
	return false;	
}
