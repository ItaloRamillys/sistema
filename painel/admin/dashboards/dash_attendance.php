<?php
require_once('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');

$conexao = new Conexao();
$conexao = $conexao->conectar();
$input = $_GET['input'];

//QTDE FALTA POR MÊS E DISCIPLINA
$queryChart = "select d.nome_disc, y.qtde_falta from disciplina d inner join (select dt.*, count(dt.id_disc) as 'qtde_falta' from disc_turma dt inner join (SELECT * FROM `frequencia2` WHERE data like '%".$input."-%' group by id_DT, data, id_aluno) x on x.id_DT = dt.id_DT and ano = 2020 group by dt.id_disc) y on y.id_disc = d.id_disc";

$stmtChart = $conexao->query($queryChart);
$rowChart = $stmtChart->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($rowChart);

?>