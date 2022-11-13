<?php
//DADO VIA GET
$year = $_GET['ano'];
require_once('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');
$conn = new Connection();
$conn = $conn->connect();

$final = "";
if($year != ""){
	$query = "select c.name_class, w.* from class c inner join (select u.name, y.* from user u inner join (select s.name_subject, x.* from subject s inner join (select * from subject_class_lesson where year = ?)x on x.id_subject = s.id_subject)y on y.id_teacher = u.id)w on w.id_class = c . id_class";
	
	$stmt = $conn->prepare($query);
    $stmt->execute([$year]);
	$dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$final = "<option value=''>Selecione a aula</option>";

	foreach ($dados as $key => $value) {
		$final .= "<option value='" . $value['id_sc'] . "'>" . $value['name_class'] . " - " . $value['name_subject'] . " - " . $value['name'] . " </option>";
	}

}else{
	$final = "<option>Selecione um ano válido</option>";
}

echo json_encode($final);
?>
