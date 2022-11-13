<?php
//DADO VIA GET
$date = $_GET['data'];
require_once('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');
$conn = new Connection();
$conn = $conn->connect();

$final = "";
if($date != ""){
	$query = "select c.id_class, c.name_class from class c inner join (select id_class from subject_class where year = " . $date . ")x on x.id_class = c.id_class";
	
	$stmt = $conn->query($query);
	
	$final = "<option value=''>Selecione a turma</option>";
	
	while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$final .= "<option value='".$dados['id_class']."'>".$dados['name_class'] . "</option>";
	}

}else{
	$final = "<option>Selecione a turma</option>";
}

echo json_encode($final);
?>
