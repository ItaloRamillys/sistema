<?php
$code_subject = sanitize_url_data($configUrl[2]);
$query_subject = "select * from subject where code_subject = '" . $code_subject . "'";
$stmt_subject = $conn->query($query_subject);
$row_subject = $stmt_subject->fetch(PDO::FETCH_ASSOC);
?>
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
                                
                                <input type="hidden" name="id_subject" value="<?=$row_subject['id_subject']?>">

                                <li><label>Código disciplina</label></li>
                                <li><input type="text" name="code_subject" placeholder="Código da displina" value="<?=$row_subject['code_subject']?>" required></li>

                                <li><label>Nome da disciplina</label></li>
                                <li><input type="text" name="name_subject" placeholder="Nome da disciplina" value="<?=$row_subject['name_subject']?>"></li>
                            </ul>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <input class="btn btn-sm btn-sm" id="btn-cad-aluno" type="submit" name="" value="Editar">
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
<script src='http://localhost/sistema/js/edit_disc.js'></script>


