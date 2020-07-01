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
<style type="text/css">
.container-activity{
	margin: 5px 5px;
    flex: calc(25% - 10px);
    max-width: calc(25% - 10px);
    width: calc(25% - 10px);
}	
.box-activity{
	box-shadow: 0px 1px 4px rgba(11,11,11,.5);
	padding: 10px;
	border-radius: 3px;
	width: 100%;
}
.container-activity:hover .box-activity{
	box-shadow: 1px 2px 4px rgba(0,0,0,.5);
	transition: .4s;
}
.t_atv{
	border-radius: 3px;
	color: #fff;
	font-size: .85em;
	padding: 5px;
	text-align: center;
}
.name_teacher_subject{
	margin: 5px 0px;
	text-align: center;
	font-size: .75em;
}
.d_atv{
	text-align: justify;
	padding: 4px 0px;
	font-size: .8em;
}
.footer-box-activity{
	padding: 5px;
	text-align: center;
}
.read-more{
	font-size: .75em;
	font-weight: 600;
}
.time-activity{
	font-size: .6em;
}
@media (max-width: 1280px){
	.container-activity{
		margin: 5px 5px;
	    flex: calc(25% - 10px);
	    max-width: calc(25% - 10px);
	    width: calc(25% - 10px);
}
@media (max-width: 991px){
	.container-activity{
		margin: 5px 5px;
	    flex: calc(33.33% - 10px);
	    max-width: calc(33.33% - 10px);
	    width: calc(33.33% - 10px);
}
@media (max-width: 768px){
	.container-activity{
		margin: 5px 5px;
	    flex: calc(50% - 10px);
	    max-width: calc(50% - 10px);
	    width: calc(50% - 10px);
}
</style>
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
					  				$date_sidebar = $split_date[2] . " de " . getMonthName(floor($split_date[1])-1) . " de " . $split_date[0];

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
<div class="container-modal container-modal-hidden" id="container-modal">
	<div class="modal">
		<input type="text" class="modal-title-activity txt-modal" data-type="modal-text" readonly>
		<textarea class="modal-desc-activity txt-modal" data-type="modal-text" readonly>
			
		</textarea>
		<p class="modal-datetime-activity txt-modal" data-type="modal-text" readonly></p>
	</div>
</div>
<style type="text/css">
	.blur{
		filter: blur(3px);
  		-webkit-filter: blur(3px);
	}
	.container-modal-hidden{
		display: none;
	}
	.container-modal{
		width: 100%;
		height: 100%;
		background-color: rgba(0,0,0,.75);
		z-index: 1;
		position: fixed;
		top: 0;
		left: 0;
	}
	.modal{
	    height: fit-content;
		border-radius: 3px;
		display: block;
		padding: 15px;
		z-index: 9999;
		color: #fff;
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		justify-content: center;
		align-items: center;
		max-width: 380px;
		width: 380px;
		background: rgba(0,0,0,.5);
		background-size: cover;
		box-sizing: border-box;
		box-shadow: 0px 4px 10px rgba(0,0,0,.5);
	}
	.txt-modal{
		margin-bottom: 5px;
	}
	.modal .modal-title-activity{
		text-align: center;
		font-size: 1.25em;
		font-weight: 600;
	}
	.modal .modal-desc-activity{	
		padding: 10px;
		border-radius: 3px;	
		border: 1px solid #fff;
		text-align: justify;
		font-size: .8em;
	}
	.modal .modal-datetime-activity{
		font-size: .6em;
		font-weight: 400;
		font-style: italic;
	}
</style>
</div>

<script src='<?="{$configBase}"?>/../js/modal_activity_student.js'></script>