<?php 
require('C:\xampp\htdocs\sistema\proj_esc_func\model\recurrence_lesson.php');
require('C:\xampp\htdocs\sistema\proj_esc_func\controllers\recurrence_lesson_service.php');
require('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');
$conn = new Connection();
$rec_lesson = new RecurrenceLesson();
if($action == 'cad'){
	
	$day_of_week = $_POST['day_of_week'];
	$order_lesson = $_POST['order_lesson'];
	$id_subject = $_POST['id_subject'];
	$id_teacher = $_POST['id_teacher'];
	$id_class = $_POST['id_class'];
	$year = $_POST['year'];
	
	$rec_lesson->__set('day_of_week', $day_of_week);
	$rec_lesson->__set('order_lesson', $order_lesson);
	$rec_lesson->__set('id_class', $id_class);
	$rec_lesson->__set('id_subject', $id_subject);
	$rec_lesson->__set('id_teacher', $id_teacher);
	$rec_lesson->__set('year', $year);

	$rec_lesson_service = new RecurrenceLessonService($conn, $rec_lesson);
	echo json_encode($rec_lesson_service->insert());	

}else if($action == 'delete'){
	$id_recurrence_lesson = $_POST['id_recurrence_lesson'];
	$rec_lesson->__set('id_recurrence_lesson', $id_recurrence_lesson);
	$rec_lesson_service = new RecurrenceLessonService($conn, $rec_lesson);
	echo json_encode($rec_lesson_service->delete());
}
?>