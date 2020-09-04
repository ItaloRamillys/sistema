<?php 
require_once('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');
$conn = new Connection();
$conn = $conn->connect();

$id_class = $_POST['id_class'];
//VERIFICAR ANO NA QUERY ABAIXO
$query = "
select name, last_name, p.* from user u inner join (select y.*, s.name_subject from subject s inner join (select r.day_of_week, r.order_lesson, r.id_recurrence_lesson, x.* from recurrence_lesson r inner join (select id_sc, id_subject, id_teacher from subject_class_lesson sc where id_class = ?)x on x.id_sc = r.id_sc)y on y.id_subject = s.id_subject)p on p.id_teacher = u.id
";


$stmt = $conn->prepare($query);
$stmt->execute([$id_class]);
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
	$result2[$i]['id_CS'] = $dados2['id_CS'];
	$i++;
}

$result_array = array($result, $result2);
echo json_encode($result_array);
?>
