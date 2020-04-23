<?php 
session_start();

if(empty($_SESSION['verificado'])){
	echo "<h1>Erro de sessao</h1>";
	echo "<h5>".session_id()."</h5>";
}else{
	echo "<h1>Sucesso de sessao</h1>";	
	echo "<h5>".session_id()."</h5>";
}

?>