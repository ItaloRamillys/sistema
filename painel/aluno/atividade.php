<?php
$activity = $configUrl[2];

if(trim($activity) != ""){
	$query_verify = "select id_student from class_student c inner join (select s.id_class, s.year from subject_class_lesson s inner join (select * from activity where id_activity = {$activity})x on x.id_SC_activity = s.id_sc)y on y.id_class = c.id_class and y.year = c.year and c.id_student = {$id_user_menu}";
	$stmt_verify = $conn->query($query_verify);
	$row_verify = $stmt_verify->fetch(PDO::FETCH_ASSOC);
	if($row_verify){
		$query = "select * from activity where id_activity = {$activity}";
		$stmt = $conn->query($query);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$date = explode(" ", $row['created_at']);
		$date_formated = getStringDate($date[0]);

		if($row['deadline_activity']){
			$deadline_formated = getStringDate($row['deadline_activity']);
		}else{
			$deadline_formated = "Data não informada";
		}
	}else{
		header("Location: http://localhost/sistema/painel/erro_permissao");
	}
}else{	
	header("Location: http://localhost/sistema/painel/erro_permissao");
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-9 col-12">
			<div class="box">
				<div class="div-title-box">
					<span class="title-box-main d-flex justify-content-center">Atividade</span>
				</div>
				<div id="container-box-activity">
					<div id="box-text-activity">
						<div class="col-12" id="text-activity">
							<label>Título da atividade</label>
							<p><?= $row['title_activity'] ?></p>
							<label>Descrição da atividade</label>
							<p><?= $row['desc_activity'] ?></p>
							<label>Referências da atividade</label>
							<p><?= $row['references_activity'] ?></p>
						</div>
						
						<div id="date-activity">
							<div>
								<label>Data de postagem</label>
								<p><?= $date_formated ?></p>
							</div>
							<div>
								<label>Data de entrega</label>
								<p><?= $deadline_formated ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-12">
			<?php require("{$configThemePath}/sidebar.php"); ?>
		</div>
	</div>
</div>
