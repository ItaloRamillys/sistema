<?php
//DADO VIA GET
$id_class = $_GET['data'];
require_once('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');
$conn = new Connection();
$conn = $conn->connect();

$array_final = array();
$array_shift = array();
$array_lessons = array();

$final = "";
if($id_class != ""){
	$query_shift = "select c.shift from class c where id_class = {$id_class}";
	$stmt_shift = $conn->query($query_shift);
	$data_shift = $stmt_shift->fetch(PDO::FETCH_ASSOC);

	if(isset($data_shift)){
		array_push($array_final, $data_shift);
	}

	$query = "select name, last_name, p.* from user u inner join (select y.*, s.name_subject from subject s inner join (select r.day_of_week, r.order_lesson, r.id_recurrence_lesson, x.* from recurrence_lesson r inner join (select id_sc, id_subject, id_teacher from subject_class_lesson sc where id_class = ?)x on x.id_sc = r.id_sc)y on y.id_subject = s.id_subject)p on p.id_teacher = u.id
";
	
	
	$stmt = $conn->prepare($query);
	$stmt->execute([$id_class]);
	
	$final = "";
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	if($data && isset($data_shift)){
		$array_lesson_single = array();
		foreach ($data as $key => $value) {
			$array_lesson_single['id_recurrence_lesson'] = $value['id_recurrence_lesson'];
			$array_lesson_single['order_lesson'] = $value['order_lesson'];
			$array_lesson_single['name_subject'] = $value['name_subject'];
			$array_lesson_single['day_of_week'] = $value['day_of_week'];
			
			array_push($array_lessons, $array_lesson_single);
		}
	}
	array_push($array_final, $array_lessons);
}else{
	array_push($array_final, array());
}

echo json_encode($array_final);
?>
