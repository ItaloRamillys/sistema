<?php
require_once('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');

$conexao = new Connection();
$conexao = $conexao->connect();
$input_class   = $_GET['input_class'];
$input_year   = $_GET['input_year'];

//Media por turma
$queryChart = "select b.*, c.name_class from class c inner join( select avg(o.value_grade) as 'media', i.name_subject as 'disc', i.id_class, o.id_SC from grade o inner join ( select y.name_subject, w.id_SC, w.id_class from subject y inner join (select dt.* from subject_class_lesson dt inner join (select tu.id_class from class tu where tu.name_class = '{$input_class}')n on n.id_class = dt.id_class and dt.year = {$input_year})w on y.id_subject = w.id_subject)i on i.id_SC = o.id_sc group by o.id_sc) b on b.id_class = c.id_class";

/**/

$stmtChart = $conexao->query($queryChart);
$rowChart = $stmtChart->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($rowChart);

?>