<?php 
$ano_atual = date("Y");
$array_activitys = array();
$array_lessons = array();

$query = "select name_class, w.name_subject, w.title_activity, w.desc_activity, w.created_at, w.id_activity, w.file_activity from class c inner join (select s.name_subject, y.id_class, y.title_activity, y.desc_activity, y.id_activity, y.created_at, y.file_activity from subject s inner join (select sc.id_SC, sc.id_class, sc.id_subject, x.id_author_activity, x.title_activity, x.desc_activity, x.id_activity, x.created_at, x.file_activity from subject_class_lesson sc inner join (select * from activity a where a.id_author_activity = {$id_user_menu})x on sc.id_SC = x.id_SC_activity)y on y.id_subject = s.id_subject)w on w.id_class = c.id_class";

$stmt = $conn->query($query);
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
$array_colors = ['#355c7d', '#725a7a', '#c56d86', '#ff7582']; 
?>
<div class="container" id="agenda">
	<div class="row">
      <div class="col-md-9 col-sm-12 col-xs-12">
		<div class="box">
	        <div class="div-title-box">
	       		<span class="title-box-main d-flex justify-content-center">Agendas</span>
	        </div>
	        <div class="container">
	        	<div class="row px-2">
	        		
	        	<?php
	        	$c = 0;
	        	foreach ($row as $key => $value) {
	        	
	        	?>

	        	<div class="container-activity">
	        		<div class="box-activity">
        				<p class="t_atv" style="background-color: <?=$array_colors[$c]?>">
	        				<?= $value['title_activity'] ?>
	        			</p>
	        			<p class="d_atv my-2">
	        			<?php 
	        				$desc = $value['desc_activity'];
	        				if (strlen($desc) > 170) {

							    $stringCut = substr($desc, 0, 170);
							    $endPoint = strrpos($stringCut, ' ');
							    $stringCut .= "...";
							    $desc = $stringCut;

							}
	        				echo $desc; 
	        			?>
	        			</p>
	        			<?php
	        			$has_file = $value['file_activity'];
		                if($has_file){
		                ?>
		                  <a href="<?=$configBase."/../uploads/".$has_file?>" target="_blank" class='btn btn-sm btn-primary my-2' style="background-color: <?='var(--theme-color-'.($c+1).')'?>">Arquivo em anexo</a> 
		                <?php
		                }
		                ?>
	        			<div class="footer-box-activity mt-2">
		        			<p class="time-activity">
		        				<i class="fas fa-clock"></i> 
		        				<?php 
		        					$split_date = explode(" ", $value['created_at']);
					  				$date_sidebar = getStringDate($split_date[0]);

		        					echo $date_sidebar
		        				?>
		        			</p>
		        			<p class="read-more my-1">
		        				<a href="<?=$configBase."/professor/editar_atividade/".$value['id_activity']?>" id="atv-<?=$value['id_activity']?>">Editar</a>
		        			</p>
	        			</div>
	        		</div>
	        	</div>

	        	<?php	
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
		<input type="text" class="modal-title-activity txt-modal" data-type="modal-text">
		<textarea class="modal-desc-activity txt-modal" data-type="modal-text">
			
		</textarea>
		<p class="modal-datetime-activity txt-modal" data-type="modal-text"></p>
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

