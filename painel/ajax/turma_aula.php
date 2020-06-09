<?php 

$turma = $_GET['turma'];

require_once('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');

$conexao = new Conexao();

$conexao = $conexao->conectar();

//VERIFICAR ANO NA QUERY ABAIXO

$query = "select l.nome_disc, l.nome, g.dia_da_semana, g.horario_de_termino, g.horario_de_inicio from recorrencia_disciplina g inner join( select d.nome_disc, k.nome, k.id_DT from disciplina d inner join (select tu.nome_turma, o.* from turma tu inner join (select u.nome, w.* from usuario u inner join (select * from disc_turma t where t.ano = 2020 and t.id_turma = 11) w on w.id_prof = u.id) o on o.id_turma = tu.id_turma order by tu.nome_turma) k on k.id_disc = d.id_disc)l on l.id_DT = g.id_TD";

$stmt = $conexao->query($query);

$result = array();

while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$result[] = $dados;
}

$ano = date('Y');

//VERIFICAR ANO NA QUERY ABAIXO

$query2 = "select u.img_profile, u.nome, u.sobrenome, x.* from usuario u inner join (select id_aluno, id_TA from turma_aluno where id_turma = {$turma}) x on u.id = x.id_aluno
";

$stmt2 = $conexao->query($query2);

$result2 = array();

$i = 0;
while ($dados2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
	if(is_file('C:/xampp/htdocs/sistema/img/'.$dados2['img_profile'])){
		$result2[$i]['img_profile'] = $dados2['img_profile'];
	}else{
		$result2[$i]['img_profile'] = "padrao/icon-profile.png";
	}
	$result2[$i]['nome'] = $dados2['nome'];
	$result2[$i]['sobrenome'] = $dados2['sobrenome'];
	$i++;
}

$result_array = array($result, $result2);

echo json_encode($result_array);

?>
