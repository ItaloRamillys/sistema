<?php

    
  include_once('C:\xampp\htdocs\sistema\authentic.php');

    if($_SESSION['tipo'] != 0){
      header("Location: inicio.php?perm=erro_perm");
    }
    
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
             

    <div class="row m-0">

        <?php

          require '../menu.php';
           
        ?>

      
        <div class="col-md-10 pb-4">
            <div class="row">
              <div class="col-md-10 col-sm-12 col-xs-12">        
                
                <div class="box">
                 <div class="div-title-box">       
                <span class="title-box-main  d-flex justify-content-center">Boletim</span>
                 </div>       
                        <table id="tabela-scroll" class="table table-hover">
                          <thead>
                            <tr>
                                <th>Joaquim</th>
                                <th>AP1</th>
                                <th>AP2</th>
                                <th>AP3</th>
                                <th>AP4</th>
                                <th>AF</th>
                                <th>NF</th>
                                <th>Resultado</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                                <td>Português </td>
                                <td>8</td>
                                <td>7</td>
                                <td>9</td>
                                <td>9</td>
                                <td>8</td>
                                <td>7</td>
                                <td>Aprovado</td>
                            </tr>
                            <tr>
                                <td>Matemática </td>
                                <td>8</td>
                                <td>8</td>
                                <td>8</td>
                                <td>9</td>
                                <td>9</td>
                                <td>9</td>
                                <td>Aprovado</td>
                            </tr>
                            <tr>
                                <td>História</td>
                                <td>8</td>
                                <td>8</td>
                                <td>8</td>
                                <td>7</td>
                                <td>9</td>
                                <td>7</td>
                                <td>Aprovado</td>
                            </tr>
                            <tr>
                                <td>Geografia </td>
                                <td>8</td>
                                <td>8</td>
                                <td>8</td>
                                <td>7</td>
                                <td>7</td>
                                <td>9</td>
                                <td>Aprovado</td>
                            </tr>
                            <tr>
                                <td>Ciências </td>
                                <td>6</td>
                                <td>6</td>
                                <td>6</td>
                                <td>6</td>
                                <td>6</td>
                                <td>6</td>
                                <td>Aprovado</td>
                            </tr>
                            <tr>
                                <td>Religião</td>
                                <td>8</td>
                                <td>8</td>
                                <td>7</td>
                                <td>8</td>
                                <td>9</td>
                                <td>9</td>
                                <td>Aprovado</td>
                            </tr>
                            <tr>
                                <td>Educação Física</td>
                                <td>8</td>
                                <td>8</td>
                                <td>8</td>
                                <td>8</td>
                                <td>8</td>
                                <td>8</td>
                                <td>Aprovado</td>
                            </tr>
                            <tr>
                                <td>Inglês</td>
                                <td>8</td>
                                <td>8</td>
                                <td>8</td>
                                <td>8</td>
                                <td>8</td>
                                <td>8</td>
                                <td>Aprovado</td>
                            </tr>
                            <tr>
                                <td>Artes</td>
                                <td>8</td>
                                <td>8</td>
                                <td>8</td>
                                <td>8</td>
                                <td>8</td>
                                <td>8</td>
                                <td>Aprovado</td>
                            </tr>
                            
                          </tbody>
                        </table>
                    </div>
                  </div>

              <div class="col-3">
                        <div class="container">                             

                        </div>
              </div>   
              </div>   
          </div>
      </div>
    <?php include '../footer.php'; ?>
    
        </body>
</html>

