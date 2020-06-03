<?php
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