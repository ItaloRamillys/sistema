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
	$query_shift = "select c.shift from class c inner join(select sc.*, x.* from subject_class sc inner join (select * from recurrence_lesson where id_subject_class = {$id_class})x on x.id_subject_class = sc.id_SC)y on y.id_class = c.id_class";
	$stmt_shift = $conn->query($query_shift);
	$data_shift = $stmt_shift->fetch(PDO::FETCH_ASSOC);

	if(isset($data_shift)){
		$array_shift['shift'] = $data_shift;
		array_push($array_final, $array_shift);
	}

	$query = "select s.name_subject, y.order_lesson, y.id_rec_lesson, y.day_of_week from subject s inner join (select * from recurrence_lesson r inner join (select * from subject_class where id_class = {$id_class})x on x.id_SC = r.id_subject_class)y on y.id_subject = s.id_subject";
	
	$stmt = $conn->query($query);
	
	$final = "";
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	if($data && isset($data_shift)){
		$array_lesson_single = array();
		foreach ($data as $key => $value) {
			$array_lesson_single['id_rec_lesson'] = $value['id_rec_lesson'];
			$array_lesson_single['order_lesson'] = $value['order_lesson'];
			$array_lesson_single['name_subject'] = $value['name_subject'];
			$array_lesson_single['day_of_week'] = $value['day_of_week'];
			
			array_push($array_lessons, $array_lesson_single);
		}
	}else{
		array_push($array_lessons, "");
	}
	array_push($array_final, $array_lessons);
}else{
	array_push($array_final, array());
}

echo json_encode($array_final);
?>
