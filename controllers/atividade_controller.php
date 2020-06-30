<?php 
	if(isset($_GET['src'])){
		$tipo = $_GET['src'];
	}
	if(isset($_GET['action'])){
		$acao = $_GET['action'];
	}
	require_once('../proj_esc_func/controllers/atividade_controller.php');
?>