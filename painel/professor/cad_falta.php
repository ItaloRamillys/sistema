<div class="container">
  <div class="row">
    <div class="col-md-9 col-12">
      <div id="msg"></div>
      <div class="box box-cad">
        <div class="div-title-box">
          <span class="title-box-main  d-flex justify-content-center">Cadastro de falta</span>
  		  </div>
        <div class="container">
          <section class='row'> 
            <div class='container py-2'>
              <form id="form">
                <div class="col-12 justify-content-center">
                <?php 

                  $query = "select k.id_SC, h.name_subject, k.id_class, k.name_class, k.year, k.id_class from subject h inner join (select x.*, t.name_class from class t inner join (select distinct id_SC, year, id_class, id_subject from subject_class_lesson where id_teacher = {$id_user_menu}) x on t.id_class = x.id_class) k on k.id_subject = h.id_subject";
                  $stmt  = $conn->query($query);
                  
                  $result = "<div class='row justify-content-center align-items-center p-2'>
                              <div class='content-turma col-8'>
                                <div class='row'>
                                    <div class='col-4'>Selecione a turma</div>
                                    <select name='class_year' id='class_year' class='col-8'>
                                </div>
                                ";
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                      $year_q = $row['year'];
                      $turma_q = $row['name_class'];
                      $id_class_q = $row['id_class'];
                      $disc_nome = $row['name_subject'];
                      $id_SC = $row['id_SC'];
                      
                      $result .= "<option value = '{$id_class_q}-{$year_q}-{$disc_nome}-{$id_SC}'>{$turma_q} - {$disc_nome} - {$year_q}</option>";
                    }

                  $result .= "</select></div></div>";
                  echo $result;
                ?>
                </div>

                <input type="hidden" name="prof" value=<?php echo $id_user_menu ?>>

                <div class='row justify-content-center align-items-center'>
                  <label class="col-3">Data da frequência: </label>
                  <input class='col-3' type='date' name='date' id="date" required=""  max="<?= date('Y-m-d'); ?>">
                </div>

                <div class='content-turma col-12 d-flex justify-content-center align-items-center'>
                  <button class='btn btn-sm btn-primary my-2 btn-falta'>Buscar</button>
                </div>

                <div  id="result-falta"></div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </div> 
    <div class="col-md-3 col-12">
        <?php require 'sidebar.php'; ?>
    </div>          
  </div>
</div>     
<script src='<?="{$configBase}/../js/falta.js"?>'></script>
<script src='<?="{$configBase}/../js/cad_falta.js"?>'></script>