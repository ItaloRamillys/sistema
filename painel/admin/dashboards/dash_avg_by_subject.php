<?php
require_once('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');

$conexao = new Connection();
$conexao = $conexao->connect();

//QTDE FALTA POR MÊS E DISCIPLINA
$queryChart = "select avg(o.value_grade) as 'media', w.name_subject as 'disc' from grade o inner join (select dt.id_sc, d.* from subject_class_lesson dt inner join (select name_subject, id_subject from subject) d on dt.id_subject = d.id_subject) w on w.id_SC = o.id_SC group by w.id_subject";

$stmtChart = $conexao->query($queryChart);
$rowChart = $stmtChart->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($rowChart);

?>