<div class="container">
    <div class="row">
        <div class="col-md-9 col-12">
            <div id="msg"></div>
            <div class="box">
                <header class="div-title-box">
                    <h1 class="title-box-main">Cadastro de disciplina</h1>
                </header>
                <div class="div-content-box my-2">
                  <form class="form-cad" id="form" action="" method="POST">
                        <div class="field-cad">
                            <ul class="list-data-form"> 
                                <li><label>Código disciplina</label></li>
                                <li><input type="text" name="code_subject" placeholder="Código da displina" required></li>
                                <li><label>Nome da disciplina</label></li>
                                <li><input type="text" name="name_subject" placeholder="Nome da disciplina"></li>
                            </ul>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <input class="btn btn-primary" id="btn-cad-aluno" type="submit" name="" value="Cadastrar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-12">
            <?php require 'sidebar.php'; ?>
        </div>
    </div>
</div>
<script src='http://localhost/sistema/js/ver_disc.js'></script>
<script src='http://localhost/sistema/js/cad_disc.js'></script>


