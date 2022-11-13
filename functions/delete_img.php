<?php

	require_once('C:\xampp\htdocs\proj_esc\authentic.php');
  	if($_SESSION['tipo'] != 2){
	    header("Location: inicio.php?perm=erro_perm");
  	}
  	require_once('C:\xampp\proj_esc_func\conexao.php');
  	$conexao = new Conexao();
  	$conexao = $conexao->conectar();

  	$path = $_POST['path_img'];

  	unlink('../img/' . $path);