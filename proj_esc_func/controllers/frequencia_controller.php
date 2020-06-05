<?php 

require('C:\xampp\htdocs\sistema\proj_esc_func\model\frequencia.php');
require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\frequencia_service.php');
require('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');

$conexao = new Conexao();

$frequencia = new Frequencia();

if($acao == 'delete'){
	$frequencia->__set('id_ta', stripcslashes($_GET['ta']));
	$frequencia->__set('id_turma', stripcslashes($_GET['turma_del']));
	$frequencia_service = new TurmaAlunoService($conexao, $frequencia);
	$frequencia_service->delete();
}
else if($acao == 'cad'){


	$data = $_POST['data'];

	$array = array_values($_POST);

	$array_ids = [];
	$array_tipos = [];

	for ($i = 0; $i < count($array[4]); $i++) { 
		if($array[4][$i] != 'p'){
			$array_ids[] = $i; 
			$array_tipos[] = $array[4][$i];
		}
	}
 
	for ($i = 0; $i < count($array_ids); $i++) { 
			$array_ids[$i] = base64_decode($array[3][$array_ids[$i]]); 
	}

	$id_aluno[] = $array_ids;
	$tipo_falta[] = $array_tipos;


	$turma_ano = explode('-', $_POST['turma_ano']);

	$id_DT = $turma_ano[3];

	$frequencia->__set('id_aluno', $id_aluno);
	$frequencia->__set('tipo_falta', $tipo_falta);
	$frequencia->__set('id_DT', $id_DT);
	$frequencia->__set('data', $data);

	$frequencia_service = new FrequenciaService($conexao, $frequencia);
	echo json_encode($frequencia_service->insert());
}else if($acao == 'update'){

}

?>