<?php 

$id_DT = $_GET['id_DT'];

$data = $_GET['data'];

require_once('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');

$conexao = new Conexao();

$conexao = $conexao->conectar();

//VERIFICAR ANO NA QUERY ABAIXO

$query = "select nome, sobrenome, img_profile, k.* from usuario u inner join (select y.*, IFNULL(w.tipo_falta, 'p') as 'freq' from (select ta.id_aluno from turma_aluno ta inner join (SELECT id_turma, ano from disc_turma dt WHERE id_DT = {$id_DT})x on x.id_turma = ta.id_turma and x.ano = ta.ano) y left join (SELECT id_aluno, tipo_falta from frequencia2 f WHERE f.id_DT = {$id_DT} and f.data = {$data}) w on y.id_aluno = w.id_aluno)k on k.id_aluno = u.id";

$stmt = $conexao->query($query);

$result = array();

$array_aux = array();

while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {

	$array_aux['id'] = base64_encode($dados['id_aluno']);
	$array_aux['freq'] = $dados['freq'];
	$array_aux['nome'] = $dados['nome'];
	$array_aux['sobrenome'] = $dados['sobrenome'];
	$array_aux['img_profile'] = $dados['img_profile'];

	$result[] =  $array_aux;
}

$result_array = array($result);

echo json_encode($result_array);

?>
