
<div class="col-md-10 col-sm-12 conteudo">
      
  <div class="box box-cad">
    <div class="div-title-box">
      <span class="title-box-main  d-flex justify-content-center">Cadastro de falta</span>
	  </div>
      <div class="container">
      <?php 
          msg_callback('Frequencia cadastrada com sucesso', 'Frequencia não cadastrada.<br> Erro: Algum dado pode estar repetido ou não foi aceito pelo banco de dados.<br> Verifique se a data está correta. Na maioria das vezes a data ou a turma está errada.  Se todas as checagens foram efetuadas e o problema persistir, entre em contato com o desenvolvedor.', 'cadastro', 10000);
      ?>
    <div class="msg-aluno">
      <section class='row'> 
        <div class='container'>
          <form action='../controllers/frequencia_controller.php?action=update' method='post'>
            <div class="row justify-content-center">
          <?php 

            $query = "select k.id_DT, k.hora, h.nome_disc, k.id_turma, k.nome_turma, k.ano, k.id_turma from disciplina h inner join (select x.*, t.nome_turma from turma t inner join (select distinct id_DT, ano, id_turma, id_disc, hora from disc_turma where id_prof = ".$id_user_menu.") x on t.id_turma = x.id_turma) k on k.id_disc = h.id_disc";
            $stmt  = $conexao->query($query);
            
            $result = "
                        <div class='col-12'>
                          <div class='container'>
                            <div class='row justify-content-center align-items-center my-2'>

                          <span class='col-md-4 col-12 text-center'>Selecione a turma que deseja inspecionar </span>

                          <select name='turma_ano' id='turma_ano' class='col-md-4 col-12'>
                          ";
              while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                $ano_q = $row['ano'];
                $turma_q = $row['nome_turma'];
                $id_turma_q = $row['id_turma'];
                $disc_nome = $row['nome_disc'];
                $id_DT = $row['id_DT'];
                $hora = $row['hora'];
                
                $result .= "<option value = '{$id_turma_q}-{$ano_q}-{$disc_nome}-{$id_DT}'>{$turma_q} - {$disc_nome} - {$hora} - {$ano_q}</option>";

              }

            $result .= "</select></div> </div></div>";

            echo $result;
          ?>

    </div>

            <input type="hidden" name="prof" value=<?php echo $id_user_menu ?>>
            
            <div class="container">
              <div class='row justify-content-center align-items-center'>
              <label class="col-md-3 col-12 text-center">Data da frequência: </label><input class='col-md-3 col-12' type='date' name='data' id='data' required="" max="<?= date('Y-m-d'); ?>">
            </div>
            <div>
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


