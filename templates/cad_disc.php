<?php
  include_once('C:\xampp\htdocs\sistema\authentic.php');
 
    if($_SESSION['tipo'] != 2){
      header("Location: inicio.php?perm=erro_perm");
    }

    require "../functions.php";
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>S.E.P.O.</title>
        
        <?php 
          //Import bootstrap.min.css, bootstrap.min.js, jquery, css and fonts
          include_once 'import_head.php';
        ?>
    </head>
    <body>
        <?php 
          require '../profile.php';
        ?> 

        <div class="container-fluid container-main">
          <div class="row">   
              <?php
                require '../menu.php';
              ?>
              <div class="col-md-10 col-sm-12 col-xs-12">
                  <div class="container">
                      <div id="msg"></div>
                      <div class="row">
                        <div class="col-md-6 col-12">
                              <div class="box">
                                  <div class="div-title-box">
                                      <span class="title-box-main">Cadastro de disciplina</span>
                                  </div>
                                  <div class="div-content-box">
                                    <form class="form-cad" id="form" action="" method="POST">
                                      
                                          <div class="field-cad">
                                              <ul class="list-data-form"> 
                                                  <li><label>Código disciplina</label></li>
                                                  <li><input type="text" name="cod_disc" placeholder="Código da displina" required></li>
                                                  <li><label>Nome da disciplina</label></li>
                                                  <li><input type="text" name="nome_disc" placeholder="Nome da disciplina"></li>
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
              </div>    
          </div>
        </div>
    
            
    <?php include '../footer.php'; ?>
    
    </body>
    <script src='../js/ver_disc.js'></script>
    <script src='../js/cad_disc.js'></script>
</html>

