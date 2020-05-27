<?php
require_once('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');

$conexao = new Conexao();
$conexao = $conexao->conectar();
$input_class   = $_GET['input_class'];
$input_year   = $_GET['input_year'];

//Media por turma
$queryChart = "select b.*, c.nome_turma from turma c inner join( select avg(o.nota) as 'media', i.nome_disc as 'disc', i.id_turma, o.id_DT from disc_alu_turma o inner join ( select y.nome_disc, w.id_DT, w.id_turma from disciplina y inner join ( select dt.* from disc_turma dt inner join ( select tu.id_turma from turma tu where tu.nome_turma = '{$input_class}')n on n.id_turma = dt.id_turma and dt.ano = {$input_year})w on y.id_disc = w.id_disc)i on i.id_DT = o.id_DT group by o.id_DT) b on b.id_turma = c.id_turma";

$stmtChart = $conexao->query($queryChart);
$rowChart = $stmtChart->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($rowChart);

?>