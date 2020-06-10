<?php 
require('C:\xampp\htdocs\sistema\proj_esc_func\model\mensagem_turma.php');
require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\mensagem_turma_service.php');
require('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');

$conexao = new Conexao();

$mensagem_turma = new MensagemTurma();

if($acao == 'delete'){

}
else if($acao == 'cad'){

	if (isset($_POST)) {

		$mensagem_turma->__set('titulo', $_POST['titulo']);
		$mensagem_turma->__set('mensagem', $_POST['mensagem']);
		$mensagem_turma->__set('id_DT', $_POST['id_DT']);
	
		$mensagem_turma_service = new MensagemTurmaService($conexao, $mensagem_turma);
		
		echo json_encode($mensagem_turma_service->insert());

	}

}
?>