
<div class="container"> 
<div class="row">
  <div class="col-12">   
    <div class="box box-cad">
      <header class="div-title-box">
        <h1 class="title-box-main  d-flex justify-content-center">Cadastro de turma</h1>
      </header>
      <div class="div-content-box">
        <form class="form-cad" method="POST">

					<div class="field-cad">
         		<ul class="list-data-form"> 
         			
	           	<li><label>Nome da turma</label></li>
	           	<li><input type="text" name="nome_turma" placeholder="Nome da turma" maxlength="2" pattern="^[0-9]{1}[A-Za-z]{1}"
               title="Uma turma possui o seguinte formato #@, onde # deve ser um numero e @ uma letra" required="require"></li>

              <?php $ano_atual = date("Y");?>

              <li><label>Ano de cadastro</label></li>
              <li><input type="text"  class="form-control" name="id_ano" placeholder="Ano vigente" value=<?php echo $ano_atual ?> readonly>

              </li>
	          </ul>
					</div>

	        <div class="row d-flex justify-content-center">
				     <input class="btn btn-primary" id="btn-cad-aluno" type="submit" name="" value="Cadastrar">
			    </div>

         </form>
    </div>
  </div>
</div>
</div>     
</div>     
