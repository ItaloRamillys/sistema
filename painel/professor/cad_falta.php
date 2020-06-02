<div id="msg"></div>
<div class="container">            
    <div class="box box-cad">
      <div class="div-title-box">
        <span class="title-box-main  d-flex justify-content-center">Cadastro de falta</span>
		  </div>
    <div class="container">
      
      <div class="msg-aluno">
        <section class='row'> 
          <div class='container py-2'>
            <form id="form">
              <div class="col-12 justify-content-center">
            <?php 

              $query = "select k.id_DT, h.nome_disc, k.id_turma, k.nome_turma, k.ano, k.id_turma from disciplina h inner join (select x.*, t.nome_turma from turma t inner join (select distinct id_DT, ano, id_turma, id_disc from disc_turma where id_prof = {$id_user_menu}) x on t.id_turma = x.id_turma) k on k.id_disc = h.id_disc";
              $stmt  = $conexao->query($query);
              
              $result = "<div class='row p-2'>
                          <div class='content-turma col-12 d-flex justify-content-center align-items-center'>
                            Selecione a turma que deseja inspecionar 

                            <select name='turma_ano' id='turma_ano' class='ml-3'>
                            ";
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                  $ano_q = $row['ano'];
                  $turma_q = $row['nome_turma'];
                  $id_turma_q = $row['id_turma'];
                  $disc_nome = $row['nome_disc'];
                  $id_DT = $row['id_DT'];
                  
                  $result .= "<option value = '{$id_turma_q}-{$ano_q}-{$disc_nome}-{$id_DT}'>{$turma_q} - {$disc_nome} - {$ano_q}</option>";

                }

              $result .= "</select> </div></div>";

              echo $result;
            ?>

      </div>

              <input type="hidden" name="prof" value=<?php echo $id_user_menu ?>>
              <div class='row justify-content-center align-items-center'>
                <label class="col-3">Data da frequência: </label>
                <input class='col-3' type='date' name='data' required=""  max="<?= date('Y-m-d'); ?>">
              </div>
              <div class='content-turma col-12 d-flex justify-content-center align-items-center'>
                <input type='' class='btn btn-primary my-2' value='Buscar' onclick='getDadosAjax()'>
              </div>
                <div  id="result-falta"></div>
            </form>
          </div>
        </section>
      </div>
    </div>
  </div>
</div>     
<script src='<?="{$configBase}/../js/ajax_falta.js"?>'></script>
<script src='<?="{$configBase}/../js/cad_falta.js"?>'></script>