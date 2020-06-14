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
	$row_activity = $stmt_activity->fetch(PDO::FETCH_ASSOC);
	if($row_activity){
		array_push($activitys, $row_activity);
	}
}

?>
<style type="text/css">
.container-activity{
	margin: 5px 5px;
    flex: calc(16.666% - 10px);
    max-width: calc(16.666% - 10px);
    width: calc(16.666% - 10px);
    height: 250px;
	max-height: 250px;
}	
.box-activity{
	padding: 10px;
	border-radius: 3px;
	box-shadow: 0px 1px 5px 0px rgba(0,0,0,.3);
	width: 100%;
	height: 250px;
	max-height: 250px;
	position: relative;
}
.t_atv{
	font-size: .85em;
	font-weight: 600;
	padding-bottom: 5px;
	border-bottom: 1px solid #bbb; 
}
.d_atv{
	padding: 4px 0px;
	text-align: left;
	font-size: .8em;
}
.read-more{
	font-size: .75em;
	font-weight: 600;
	position: absolute;
	bottom: 10px;
	right: 10px;
}
.name_teacher_subject{
	text-align: center;
	font-size: .75em;
}
.time-activity{
	position: absolute;
	bottom: 30px;
	right: 10px;
	font-size: .6em;
}
@media (max-width: 1280px){
	.container-activity{
		margin: 5px 5px;
	    flex: calc(25% - 10px);
	    max-width: calc(25% - 10px);
	    width: calc(25% - 10px);
	    height: 250px;
		max-height: 250px;
}
@media (max-width: 991px){
	.container-activity{
		margin: 5px 5px;
	    flex: calc(33.33% - 10px);
	    max-width: calc(33.33% - 10px);
	    width: calc(33.33% - 10px);
	    height: 250px;
		max-height: 250px;
}
@media (max-width: 768px){
	.container-activity{
		margin: 5px 5px;
	    flex: calc(50% - 10px);
	    max-width: calc(50% - 10px);
	    width: calc(50% - 10px);
	    height: 250px;
		max-height: 250px;
}
</style>
<div class="container">
	<div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="box">
	        <div class="div-title-box">
	       		<span class="title-box-main d-flex justify-content-center">Agendas</span>
	        </div>
	        <div class="container">
	        	<div class="row">
	        		
	        	<?php 
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
	        			<p class="t_atv">
	        				<?php echo $activitys[$i]['titulo_atv']; ?>
	        			</p>
	        			<p class="name_teacher_subject">
	        				<?php echo $name_teacher . " - " . $name_subject ?>
	        			</p>
	        			<p class="d_atv">
	        				<?php 

	        				$desc = $activitys[$i]['desc_atv'];

	        				if (strlen($desc) > 170) {

							    $stringCut = substr($desc, 0, 170);
							    $endPoint = strrpos($stringCut, ' ');
							    $stringCut .= "...";
							    $desc = $stringCut;

							 }

	        				echo $desc; 

	        				?>
	        			</p>
	        			<p class="time-activity">
	        				<i class="fas fa-clock"></i> <?php echo $activitys[$i]['create_at'] ?>
	        			</p>
	        			<p class="read-more">
	        				<a href="<?=$configBase?>/aluno/atividade/<?=$activitys[$i]['id_atv']?>" class="text-primary">Ler mais</a>
	        			</p>
	        		</div>
	        	</div>

	        	<?php	}	
	        	}else{
	        		echo "<p class='msg msg-warn'>Nenhuma atividade cadastrada</p>";
	        	}

	        	?>
	        	</div>
	        </div>  
	    </div>
	</div>
	</div>
</div>
	         
