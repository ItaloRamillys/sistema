<?php
require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\autoload.php');
use Helpers\Image;

//Função que move o arquivo para o servidor e retorna o caminha da imagem relativo, resultado (true or false) e a mesnagem de retorno a ser exibida.

function upload_file($dir, $model = null, $file, $hash, $can_rename = null){

	$model = $model;
	
	$year  = date("Y");
	$month = date("m");

	$start_path = $dir;

	$year_dir  = $start_path . $model . "/" . $year;
	$month_dir = $start_path . $model . "/" . $year."/".$month;

	if(!is_null($model)){
		$model .= "/";
	}
	
	create_dir($year_dir, $month_dir, 2048000, $file['size']);

	$typeFile = "";

	$typeFile = explode(".", $file['name']);
	$uploadfile = $month_dir . "/" . $file['name'];

	if (is_file($uploadfile) && $can_rename == 1) {
		$name_img_final = $typeFile[0].date('-YmdHis-').hash('crc32',$hash).".".$typeFile[1];
	}else if(is_file($uploadfile) && $can_rename != 1) {
		$array_return['result'] = false;
		//expected_return == n, não resetar o formulario
		$array_return['expected_return'] = "n";
		$array_return['msg_return'] = "Existe um arquivo no servidor com este mesmo nome. Renomeie seu arquivo para realiza o upload.";
		return $array_return;
	}else{
		$name_img_final = $file['name'];
	}

	$uploadfile = $month_dir . "/" . $name_img_final;

	if(move_uploaded_file($file['tmp_name'], $uploadfile)){
		return $model . $year."/".$month."/".$name_img_final;
	}
	return false;
}


function upload_image($dir, $model = null, $file, $hash, $can_rename = null){

	$msg_return = "";
	$result = null;
	$array_return = array();

	$model = $model;
	
	$year  = date("Y");
	$month = date("m");

	$start_path = $dir;

	$year_dir  = $start_path . $model . "/" . $year;
	$month_dir = $start_path . $model . "/" . $year."/".$month;

	//Nome do modelo dos BD = nome da pasta, se nao tiver modelo fica salvo na Root
	if(!is_null($model)){
		$model .= "/";
	}

	create_dir($year_dir, $month_dir, 2048000, $file['size']);

	$typeFile = "";
	$typeFile = explode(".", $file['name']);
	$uploadfile = $month_dir . "/" . $file['name'];

	if (is_file($uploadfile) && $can_rename == 1) {
		$name_img_final = $typeFile[0].date('-YmdHis-').hash('crc32',$hash).".".$typeFile[1];
	}else if(is_file($uploadfile) && $can_rename != 1) {
		$array_return['result'] = false;
		//expected_return == n, não resetar o formulario
		$array_return['expected_return'] = "n";
		$array_return['msg_return'] = "Existe uma imagem no servidor com este mesmo nome. Renomeie seu arquivo para realiza o upload.";
		return $array_return;
	}else{
		$name_img_final = $file['name'];
	}

	$uploadfile = $month_dir . "/" . $name_img_final;

	$img_resized = false;

	if(move_uploaded_file($file['tmp_name'], $uploadfile)){
		$array_return['result'] = true;
		$array_return['msg_return'] = "Upload feito com sucesso";		
		$array_return['expected_return'] = $model . $year."/".$month."/".$name_img_final;
		return $array_return;
	}
		
	$array_return['result'] = false;
	$array_return['msg_return'] = "Falha ao realizar upload";		
	$array_return['expected_return'] = null;
	return $array_return;	
}

function create_dir($year_dir, $month_dir, $max_file_size, $file_size){
	if(!is_dir($year_dir)){
		mkdir($year_dir, 0755);
	}
	if(!is_dir($month_dir)){
		mkdir($month_dir, 0755);
	}
	//Restrição de tamanho máximo de arquivo
	if($file_size > $max_file_size){
		$array_return['result'] = false;
		$array_return['expected_return'] = null;
		$array_return['msg_return'] = "Tamanho máximo do arquivo deve ser 2MB";
		return $array_return;
	}
}