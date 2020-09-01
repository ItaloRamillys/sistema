<div class="container">
    <div class="row">
        <div class="col-md-9 col-12">
            <div class="box">
                <div class="div-title-box">
                    <h1 class="title-box-main d-flex justify-content-center">Turma</h1>
                </div>

                <div class="container py-2">
                    <div class="row justify-content-center">
                        <?php 

                          $query = "select * from class";                      
                          $stmt  = $conn->query($query);
                          
                          $result = "
                                      <div class='col-12 py-2'>
                                        <div class='row'>
                                        <div class='col-12'>
                                            <div class='mx-2'>Selecione a turma</div> 
                                                <select name='class' id='id_class' class='w-auto mx-2'>
                                        ";
                          while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            $class = $row['name_class'];
                            $id_class = $row['id_class'];
                            $result .= "<option value='{$id_class}'>{$class}</option>";
                          }

                          $result .= "</select> <button class='btn btn-sm btn-primary mostrar-cronograma mx-2'>Buscar</button></div></div></div>";

                          echo $result;
                        ?>
                    </div>

                    <section class="col-12 text-center text-light rounded" id="box-black">
                    
                        <header class="div-title-box h5">
                            <span>
                                Cronograma da turma
                            </span>                
                        </header>

                        <section class="container">
                            <div class="row" id="dias">
                                <article class="dia_sem_aula">
                                    <header class="div-title-box h6">Segunda</header>
                                    <div id="aulas_seg">
                                        
                                    </div>

                                </article>


                                <article class="dia_sem_aula">
                                    <header class="div-title-box h6">Terça</header>
                                    <div id="aulas_ter">
                                        
                                    </div>

                                </article>


                                <article class="dia_sem_aula">
                                    <header class="div-title-box h6">Quarta</header>
                                    <div id="aulas_qua">
                                        
                                    </div>

                                </article>


                                <article class="dia_sem_aula">
                                    <header class="div-title-box h6">Quinta</header>
                                    <div id="aulas_qui">
                                        
                                    </div>

                                </article>


                                <article class="dia_sem_aula">
                                    <header class="div-title-box h6">Sexta</header>
                                    <div id="aulas_sex">
                                        
                                    </div>

                                </article>
                            </div>
                        </section>    
                    </section>
                        
                    <div class="container div-title-box rounded cronograma text-center my-3 text-light" id="box-black">
                        <div class="row">
                            <div class="col-12">
                                <header class="h5">
                                    <span>
                                    Participantes da turma
                                    </span>                
                                </header>   
                                <div class="row" id="participantes">
                                    
                                </div>    
                            </div>  
                        </div>
                    </div>
                    <div id="script"></div>
                </div>
            </div>
        </div>   
        <div class="col-md-3 col-12">
            <?php require 'sidebar.php'; ?>
        </div>
    </div>
</div>
<script src='http://localhost/sistema/js/cronograma.js'></script>  
<style type="text/css">
    .prof-sup{
        padding: 3px;
        font-size: 9px;
        font-style: italic;
    }
</style>