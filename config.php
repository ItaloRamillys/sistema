<?php
require_once('proj_esc_func\conexao.php');

//GLOBAIS E CONSTANTES
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

function is_admin($user_name){
	$conexao = new Conexao();
	$conexao = $conexao->conectar();
	$query_is_admin = "select tipo from usuario where login = '{$user_name}'"; 
	$stmt_is_admin  = $conexao->query($query_is_admin);
	$row_is_admin   = $stmt_is_admin->fetch(PDO::FETCH_ASSOC);
	if($row_is_admin == 2){
		return true;
	}
	return false;
}