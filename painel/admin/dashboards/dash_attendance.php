<?php
require_once('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');


$conexao = new Connection();
$conexao = $conexao->connect();
$input = $_GET['input'];

$year = explode('-', $_GET['input'])[0];

//QTDE FALTA POR MÊS E DISCIPLINA
$queryChart = "select d.name_subject, y.qtde_falta from subject d inner join (select dt.*, count(dt.id_subject) as 'qtde_falta' from subject_class_lesson dt inner join (SELECT * FROM attendance WHERE date like '%".$input."-%' group by id_SC, date, id_user) x on x.id_SC = dt.id_sc and year = {$year} group by dt.id_subject) y on y.id_subject = d.id_subject";

$stmtChart = $conexao->query($queryChart);
$rowChart = $stmtChart->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($rowChart);

?>