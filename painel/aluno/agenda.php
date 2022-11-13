<?php 
$ano_atual = date("Y");
$query_id_class = "select id_class from class_student where id_student = {$id_user_menu} and year = {$ano_atual}";
$stmt_id_class = $conn->query($query_id_class);
$row_id_class = $stmt_id_class->fetch(PDO::FETCH_ASSOC);
if($row_id_class){
	$id_class = $row_id_class['id_class']; 
	$query_id_dt = "select id_sc from subject_class_lesson where id_class = {$id_class} and year = {$ano_atual}";
	$stmt_id_dt = $conn->query($query_id_dt);
	$row_id_dt = $stmt_id_dt->fetchAll(PDO::FETCH_ASSOC);

	$activitys = [];
	if($row_id_dt){
		foreach ($row_id_dt as $key => $value) {
			$query_activity = "select * from activity where id_SC_activity = {$value['id_sc']}";
			$stmt_activity = $conn->query($query_activity);
			$row_activity = $stmt_activity->fetchAll(PDO::FETCH_ASSOC);
			foreach ($row_activity as $key2 => $value2) {
					if($row_activity){
						array_push($activitys, $value2);
					}
			}
		}
	}
}

?>
<div class="container">
	<div class="row">
        <div class="col-md-9 col-sm-12 col-xs-12">
			<div class="box">
		        <div class="div-title-box">
		       		<span class="title-box-main d-flex justify-content-center">Agenda</span>
		        </div>
		        <div class="container">
			        <div class="col-12">
			        	<div class="row">
		        		
			        	<?php
			        	$c = 0;
			        	if(isset($activitys) && count($activitys)>0){
			        		for($i = 0; $i < count($activitys); $i++){
			        		
				        		$id_atv = $activitys[$i]['id_activity'];
				        		$id_dt = $activitys[$i]['id_SC_activity'];
				        		$query_n_teacher_n_subj = "select name_subject, y.name from subject d inner join (SELECT name, x.* from user u inner join (select id_teacher, id_subject from subject_class_lesson dt WHERE dt.id_sc = {$id_dt}) x on x.id_teacher = u.id) y on y.id_subject = d.id_subject";
				        		$stmt_n_teacher_n_subj = $conn->query($query_n_teacher_n_subj);
				        		$row_n_teacher_n_subj = $stmt_n_teacher_n_subj->fetch(PDO::FETCH_ASSOC);

				        		$name_teacher = $row_n_teacher_n_subj['name'];
				        		$name_subject = $row_n_teacher_n_subj['name_subject'];

			        	?>

			        	<div class="container-activity">
			        		<div class="box-activity">
			        			<p class="t_atv" style="background-color: <?='var(--theme-color-'.($c+1).')'?>">
			        				<?php echo $activitys[$i]['title_activity']; ?>
			        			</p>
			        			<p class="name_teacher_subject">
			        				<?php echo $name_teacher . " - " . $name_subject ?>
			        			</p>
			        			<p class="d_atv">
			        				<?php 
			        				$desc = $activitys[$i]['desc_activity'];
			        				if (strlen($desc) > 150) {

									    $stringCut = substr($desc, 0, 150);
									    $endPoint = strrpos($stringCut, ' ');
									    $stringCut .= "...";
									    $desc = $stringCut;

									 }
			        				echo $desc; 
			        				?>
			        			</p>
			        			<?php
			        			$has_file = $activitys[$i]['file_activity'];
				                if($has_file){
				                ?>
				                  <a href="<?=$configBase."/../uploads/".$has_file?>" target="_blank" class='btn btn-sm btn-primary my-2' style="background-color: <?='var(--theme-color-'.($c+1).')'?>">Arquivo em anexo</a> 
				                <?php
				                }
				                ?>
			        			<div class="footer-box-activity">
				        			<p class="time-activity">
				        				<i class="fas fa-clock"></i> 
				        				<?php 
				        					$split_date = explode(" ", $activitys[$i]['created_at']);
				        					$split_date = $split_date[0];
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