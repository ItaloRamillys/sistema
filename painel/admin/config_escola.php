<?php
$query_config_school = "select count(*) from config_school";
$stmt_config_school = $conn->query($query_config_school);
$row_config_school = $stmt_config_school->fetch(PDO::FETCH_ASSOC);
?>
<div class="container">
<div id="msg"></div>
  <div class="row">
    <div class="col-md-9 col-12">
      <div class="box">
        <header class="div-title-box">
          <h1 class="title-box-main  d-flex justify-content-center">Configurações globais da escola</h1>
        </header>
        <div class="div-content-box">
          <form id="form" method="POST" enctype="multipart/form-data">
            <div class="row justify-content-center">
             	<ul class="col-md-6 col-12 my-2">

                <li><label>Horário de início das aula</label></li>
                <li><input type="text" name="start_time_lesson" placeholder="Ex. 07:00/08:00/09:00/10:00"></li>
                  
                <li><label>Horário de término da aula</label></li>
                <li><input type="text" name="end_time_lesson" placeholder="Ex. 07:50/08:50/09:50/10:50"></li>
                  
                <li><label>Média da escola</label></li>
                <li><input type="text" name="avg_grade" placeholder="Digite um valor númerico(Ex.7.0)" onkeypress="onlynumber()"></li>
                
              </ul>
              <ul class="col-md-6 col-12 my-2">

                <li><label>Número máximo de faltas (Em dias)</label></li>
                <li><input type="text" name="max_missing" placeholder="Digite um valor númerico(Ex.20)"></li>
                  
                <li><label>Número máximo de faltas abonadas (Não inclui exceções)</label></li>
                <li><input type="text" name="missing_allowance" placeholder="Digite um valor númerico(Ex.10)"></li>
                
              </ul>
              <input class="btn btn-sm my-2" type="submit" value="Cadastrar">
      	    </div>	
         </form>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-12">
      <?php require("{$configThemePath}/sidebar.php"); ?>
    </div>
  </div>
</div>
<script src='<?="{$configBase}"?>/../js/config_school.js'></script>
<script src='<?="{$configBase}"?>/../js/only_number.js'></script>

