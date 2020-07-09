<?php
//DADO VIA GET
$date = $_GET['data'];
require_once('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');
$conn = new Connection();
$conn = $conn->connect();

$final = "";
if($date != ""){
	$query = "select h.name_subject, k.name_class, k.year, k.id_SC from subject h inner join (select x.*, c.name_class from class c inner join (select distinct id_SC, year, id_class, id_subject from subject_class where year = '".$date."') x on c.id_class = x.id_class) k on k.id_subject = h.id_subject";
	
	$stmt = $conn->query($query);
	
	$final = "<option value=''>Selecione a disciplina com a turma</option>";
	
	while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$final .= "<option value='".$dados['id_SC']."'>".$dados['name_subject']."-".$dados['name_class']."</option>";
	}

}else{
	$final = "<option>Selecione um ano</option>";
}

echo json_encode($final);
?>
