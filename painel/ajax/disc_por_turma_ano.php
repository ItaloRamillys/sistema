<?php
//DADO VIA GET
$class = $_GET['c'];
$year = $_GET['y'];
require_once('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');
$conn = new Connection();
$conn = $conn->connect();

$final = "";
if($class != "" && $year != ""){
	$query = "select c.id_subject, c.name_subject from subject c inner join (select id_subject from subject_class where year = " . $year . " and id_class = " . $class . ")x on x.id_subject = c.id_subject";
	
	$stmt = $conn->query($query);
	
	$final = "<option value=''>Selecione a disciplina</option>";
	
	while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$final .= "<option value='".$dados['id_subject']."'>".$dados['name_subject'] . "</option>";
	}

}else{
	$final = "<option>Selecione uma turma válida</option>";
}

echo json_encode($final);
?>
