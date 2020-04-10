<?php 

require('C:\xampp\htdocs\sistema\proj_esc_func\model\nota.php');
require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\nota_service.php');
require('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');

$conexao = new Conexao();

$nota = new Nota();

if($acao == 'delete'){
	$nota->__set('id_ta', stripcslashes($_GET['ta']));
	$nota->__set('id_turma', stripcslashes($_GET['turma_del']));
	$nota_service = new TurmaAlunoService($conexao, $nota);
	$nota_service->delete();
}
else if($acao == 'cad'){

	$array = array_values($_POST);

	var_dump($_POST);

	$array_ids = [];
	$array_notas = [];

	for ($i = 0; $i < count($array[4]); $i++) { 	
			$array_notas[$i] = $array[4][$i];
	}
 
	for ($i = 0; $i < count($array_notas); $i++) { 
			$array_ids[$i] = base64_decode($array[3][$i]); 
	}

	$periodo = $_POST['periodo'];

	$turma_ano = explode('-', $_POST['turma_ano']);	
	$id_DT = $turma_ano[3];

	$nota->__set('id_aluno', $array_ids);
	$nota->__set('periodo', $periodo);
	$nota->__set('id_DT', $id_DT);
	$nota->__set('nota', $array_notas);


	$nota_service = new notaService($conexao, $nota);
	$nota_service->insert();
	
}

?>