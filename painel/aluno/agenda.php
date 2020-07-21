<?php 

$ano_atual = date("Y");
$query_id_class = "select id_turma from turma_aluno where id_aluno = {$id_user_menu} and ano = {$ano_atual}";
$stmt_id_class = $conexao->query($query_id_class);
$row_id_class = $stmt_id_class->fetch(PDO::FETCH_ASSOC);
$id_class = $row_id_class['id_turma']; 

$query_id_dt = "select id_DT from disc_turma where id_turma = {$id_class} and ano = {$ano_atual}";
$stmt_id_dt = $conexao->query($query_id_dt);
$row_id_dt = $stmt_id_dt->fetchAll(PDO::FETCH_ASSOC);

$activitys = [];

foreach ($row_id_dt as $key => $value) {
$query_activity = "select * from atividade where id_DT = {$value['id_DT']}";
$stmt_activity = $conexao->query($query_activity);
$row_activity = $stmt_activity->fetchAll(PDO::FETCH_ASSOC);
	foreach ($row_activity as $key2 => $value2) {
  		if($row_activity){
    		array_push($activitys, $value2);
  		}
	}
}

$array_colors = ['#355c7d', '#725a7a', '#c56d86', '#ff7582']; 

?>
<div class="container">
	<div class="row">
        <div class="col-md-9 col-sm-12 col-xs-12">
			<div class="box">
		        <div class="div-title-box">
		       		<span class="title-box-main d-flex justify-content-center">Agendas</span>
		        </div>
		        <div class="container">
		        	<div class="row">
	        		
		        	<?php
		        	$c = 0;
		        	if(count($activitys)>0){
		        		for($i = 0; $i < count($activitys); $i++){
		        		
		        		$id_atv = $activitys[$i]['id_atv'];
		        		$id_dt = $activitys[$i]['id_DT'];
		        		$query_n_teacher_n_subj = "select nome_disc, y.nome from disciplina d inner join (SELECT nome, x.* from usuario u inner join (select id_prof, id_disc from disc_turma dt WHERE dt.id_DT = {$id_dt}) x on x.id_prof = u.id) y on y.id_disc = d.id_disc";
		        		$stmt_n_teacher_n_subj = $conexao->query($query_n_teacher_n_subj);
		        		$row_n_teacher_n_subj = $stmt_n_teacher_n_subj->fetch(PDO::FETCH_ASSOC);

		        		$name_teacher = $row_n_teacher_n_subj['nome'];
		        		$name_subject = $row_n_teacher_n_subj['nome_disc'];

		        	?>

		        	<div class="container-activity">
		        		<div class="box-activity">
		        			<p class="t_atv" style="background-color: <?=$array_colors[$c]?>">
		        				<?php echo $activitys[$i]['titulo_atv']; ?>
		        			</p>
		        			<p class="name_teacher_subject">
		        				<?php echo $name_teacher . " - " . $name_subject ?>
		        			</p>
		        			<p class="d_atv">
		        				<?php 
		        				$desc = $activitys[$i]['desc_atv'];
		        				if (strlen($desc) > 150) {

								    $stringCut = substr($desc, 0, 150);
								    $endPoint = strrpos($stringCut, ' ');
								    $stringCut .= "...";
								    $desc = $stringCut;

								 }
		        				echo $desc; 
		        				?>
		        			</p>
		        			<div class="footer-box-activity">
			        			<p class="time-activity">
			        				<i class="fas fa-clock"></i> 
			        				<?php 
			        					$split_date = explode(" ", $activitys[$i]['create_at']);
			        					$split_date = explode("-", $split_date[0]);
						  				$date_sidebar = getStringDate($split_date);

			        					echo $date_sidebar
			        				?>
			        			</p>
			        			<p class="read-more mt-3">
			        				<a href="" id="atv-<?=$id_atv?>" class="btn-modal-activity">Visualizar</a>
			        			</p>
		        			</div>
		        		</div>
		        	</div>

		        	<?php 
		        		$c++;
				        		if($c > 3){
				        			$c = 0; 
				        		}
			        		}	
			        	}else{
			        		echo "<p class='msg msg-warn'>Nenhuma atividade cadastrada</p>";
			        	}
	        		?>
		        	</div>		
		        </div>  
		    </div>
		</div>
		<div class="col-md-3 col-12">
	    	<?php require 'sidebar.php'; ?>
		</div>
	</div>
</div>
<div class="container-modal container-modal-hidden" id="container-modal">
	<div class="modal">
		<input type="text" class="modal-title-activity txt-modal" data-type="modal-text" readonly>
		<textarea class="modal-desc-activity txt-modal" data-type="modal-text" readonly>
			
		</textarea>
		<p class="modal-datetime-activity txt-modal" data-type="modal-text" readonly></p>
	</div>
</div>
<script src='<?="{$configBase}"?>/../js/modal_activity_student.js'></script>