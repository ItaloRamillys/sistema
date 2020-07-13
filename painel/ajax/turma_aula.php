<?php 
require_once('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');
$conn = new Connection();
$conn = $conn->connect();

$id_class = $_POST['id_class'];
//VERIFICAR ANO NA QUERY ABAIXO
$query = "select l.name_subject, l.name, g.day_of_week, g.end_time_lesson, g.start_time_lesson from recurrence_lesson g inner join( select d.name_subject, k.name, k.id_SC from subject d inner join (select tu.name_class, o.* from class tu inner join (select u.name, w.* from user u inner join (select * from subject_class t where t.year = 2020 and t.id_class = {$id_class}) w on w.id_teacher = u.id) o on o.id_class = tu.id_class order by tu.name_class) k on k.id_subject = d.id_subject)l on l.id_SC = g.id_subject_class";

$stmt = $conn->query($query);
$result = array();
while($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
	$result[] = $dados;
}

//VERIFICAR ANO NA QUERY ABAIXO
$query2 = "select u.img_profile, u.name, u.last_name, x.* from user u inner join (select id_student, id_CS from class_student where id_class = {$id_class}) x on u.id = x.id_student";

$stmt2 = $conn->query($query2);
$result2 = array();

$i = 0;
while ($dados2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
	if(is_file('C:/xampp/htdocs/sistema/img/'.$dados2['img_profile'])){
		$result2[$i]['img_profile'] = $dados2['img_profile'];
	}else{
		$result2[$i]['img_profile'] = "padrao/icon-profile.png";
	}
	$result2[$i]['name'] = $dados2['name'];
	$result2[$i]['last_name'] = $dados2['last_name'];
	$result2[$i]['id_class_student'] = $dados2['id_class_student'];
	$i++;
}

$result_array = array($result, $result2);
echo json_encode($result_array);
?>
