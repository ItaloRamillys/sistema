<?php
require_once('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');

$conexao = new Conexao();
$conexao = $conexao->conectar();

//QTDE FALTA POR MÊS E DISCIPLINA
$queryChart = "select avg(o.nota) as 'media', w.nome_disc as 'disc' from disc_alu_turma o inner join (select dt.id_DT, d.* from disc_turma dt inner join (select nome_disc, id_disc from disciplina) d on dt.id_disc = d.id_disc) w on w.id_DT = o.id_DT group by w.id_disc";

$stmtChart = $conexao->query($queryChart);
$rowChart = $stmtChart->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($rowChart);

?>