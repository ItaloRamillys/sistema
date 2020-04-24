<div class="container">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="box">
			<div class="div-title-box">
				<span class="title-box-main d-flex justify-content-center">Cadastro de atividades</span>
			</div>
			<div class="container py-2 px-3">
				<form class="" id="form" method="POST" enctype="multipart/form-data">
                  <input type="hidden" id="tipo" value="adm">
                    <div class="row">
                    	<div class="divisao-cad col-12">
                    		<article>
                    			<header>
                                    <h2 class="title-box-main  d-flex justify-content-center">Suas turmas</h2>
                                </header>
                    			
                    		<?php 

			                  $query = "select k.id_DT, k.hora, h.nome_disc, k.id_turma, k.nome_turma, k.ano, k.id_turma from disciplina h inner join (select x.*, t.nome_turma from turma t inner join (select distinct id_DT, ano, id_turma, id_disc, hora from disc_turma where id_prof = ".$id_user_menu.") x on t.id_turma = x.id_turma) k on k.id_disc = h.id_disc";
			                  $stmt  = $conexao->query($query);
			                  
			                  $result = "<div class='row p-2'>
			                              <div class='content-turma col-12 d-flex justify-content-center align-items-center'>
			                              <ul class='text-center'>
			                                <li>Selecione a turma a qual deseja cadastrar a atividade</li> 

			                                <li>
			                                <select name='turma_ano' id='turma_ano' class='mt-3'>
			                                ";
			                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

			                      $ano_q = $row['ano'];
			                      $turma_q = $row['nome_turma'];
			                      $id_turma_q = $row['id_turma'];
			                      $disc_nome = $row['nome_disc'];
			                      $id_DT = $row['id_DT'];
			                      $hora = $row['hora'];
			                      
			                      $result .= "<option value = '{$id_DT}'>{$turma_q} - {$disc_nome} - {$hora} - {$ano_q}</option>";

			                    }

			                  $result .= "</select> </li></ul></div></div>";

			                  echo $result;
			                ?>
                    		</article>
                    	</div>
                        <div class="divisao-cad col-md-8 col-sm-12">
                    	
                        	
                            <article>
                                <header>
                                    <h2 class="title-box-main  d-flex justify-content-center">Dados da atividade</h2>
                                </header>

                                <div class="row">

                                     <div class="col-12">

                                      <li><label>Titulo</label></li>
                                      <li><input type="text" name="titulo" placeholder="Título" required=""></li>

                                      <li><label>Descrição</label></li>
                                      <li><input type="text" name="descricao" placeholder="Descrição" required=""></li>
                                      <li><label>Referências</label></li>
                                      <li><input type="text" name="end"  placeholder="Links - Livros - Etc"></li>
                                      
                                      
                                    </div> 
                                </div>
                            </article>
                        </div>
                        <div class="divisao-cad col-md-4 col-sm-12">
                          <article>
                            <header>
                              <h2 class="title-box-main  d-flex justify-content-center">Arquivos necessários</h2>
                            </header>

                            <div class="row d-flex justify-content-around align-items-center p-2">
                               <ul class="text-center">
                               	
                                    <li>
                                    	<label>Arquivo PDF</label>
                                    </li>
                                    <li>
                                        <label for="file-upload1" class="custom-file-upload">
                                          Enviar Arquivo
                                        </label>
                                    </li>
                                    <li>
                                    	
                                        <input id="file-upload1" name="file_atv" type="file" style="display:none;">
                                    </li>
                                    <li>
                                    	<label id="file-name">Nome do arquivo</label>
                                    </li>
                                    <li>
                                        <img src="http://localhost/sistema/img/sistema/pdf.png" id="img1" width="100" height="100" style="border-radius: 50%;">
                                    </li>
                               </ul>
                          	</div>
                          </article>
                      </div>
                  </div>
                            <div class="row d-flex justify-content-center">
                                <input class="btn btn-primary mt-2" id="btn-cad" type="submit" name="" value="Cadastrar">
                            </div>
                        </form>
				
			</div>
		</div>
	</div>
</div>
