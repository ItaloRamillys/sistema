<?php
  include_once('C:\xampp\htdocs\sistema\authentic.php');
    if($_SESSION['tipo'] != 2){
      header("Location: inicio.php?perm=erro_perm");
    }

    require_once("../functions.php");

    require_once('C:\xampp\proj_esc_func\conexao.php');

    $conexao = new Conexao();
    $conexao = $conexao->conectar();
    $id_escola = $_SESSION['escola'];  

    if(isset($_GET['type'])){
        $tipo_get = $_GET['type'];
    }else{
        $tipo_get = $_GET['src'];
    }

    $is_user = false;
    $n_type = '';
    $title_type = '';
    $table_name = '';

    if($tipo_get == 'prof'){
        $n_type = 1;
        $title_type = 'Professor';
        $table_name = 'usuario';
        $is_user = true;
    }else if($tipo_get == 'admin'){
        $n_type = 2;
        $title_type = 'Administradores';
        $table_name = 'usuario';
        $is_user = true;
    }else if($tipo_get == 'news'){
        $n_type = 4;
        $title_type = 'Noticia';
        $table_name = 'noticia';
    }else if($tipo_get == 'aluno'){
        $n_type = 0;
        $title_type = 'Alunos';
        $table_name = 'usuario';
        $is_user = true;
    }else{
        var_dump($tipo_get);
        header("Location: inicio.php?erro=1");
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

      ?>>
    </head>
    <body>

    <?php 
        require "../profile.php";
    ?>

    <div class="row m-0"> 

        <?php
            require '../menu.php';
        ?>
        
      <div class="col-md-10 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-12 p-0">
                <?php 

                    if(isset($_GET['update']) && $is_user){
                        msg_callback('Usuário atualizado com sucesso', 'Falha ao atualizar usuário', 'update');
                    }else if(isset($_GET['delete']) && $is_user){
                         msg_callback('Usuário deletado com sucesso', 'Falha ao deletar usuário', 'delete');
                    }

                    if (isset($_GET['update']) && !$is_user) {
                       msg_callback('Noticia atualizada com sucesso', 'Falha ao atualizar noticia', 'update');
                    }else if(isset($_GET['delete']) && !$is_user){
                         msg_callback('Noticia deletada com sucesso', 'Falha ao deletar noticia', 'delete');
                    }
                                
                ?>
                    <div class="box"> 
                        <header class="div-title-box">
                            <h1 class="title-box-main  d-flex justify-content-center">Gerenciar <?php echo $title_type; ?> </h1>
                        </header>
                       
                        <div class="msg-aluno col-12 p-0">

                            <div class="container">
                            <?php 

                            $ordem = "";

                            if($is_user){
                                $cmp_query = "nome";
                            }else{
                                $cmp_query = "titulo_ntc";
                            }

                            if(isset($_GET['ordem_alfa']) && $_GET['ordem_alfa'] == 1){
                                $ordem = " order by " . $cmp_query . " asc";
                            }else if(isset($_GET['ordem_cad']) && $_GET['ordem_cad'] == 1){
                                $ordem = " order by create_at desc";
                            }

                                if($table_name == 'noticia'){
                                    $query = "select count(*) from ".$table_name;
                                }else{
                                    $query = "select count(*) from ".$table_name." where tipo = ".$n_type;
                                }
                                
                                $stmt = $conexao->query($query);

                                if ($stmt->fetchColumn() > 0) {

                                    if($table_name != 'noticia'){
                                        $query2 = "select * from ".$table_name." where tipo = ".$n_type." ".$ordem ;
                                        $stmt2 = $conexao->query($query2);

                                        $res = "<section class='row'>
                                                    <div class='col-md-3 col-12 px-3 pt-4 text-center'>
                                                       
                                                            Gerenciar contas <br>

                                                            <a href='cad_" . $tipo_get . ".php'> <button class='btn btn-outline-success btn-sm m-md-0 my-md-1 m-2'> + Adicionar</button></a>
                                                            <a href='showData.php?ordem_alfa=1&type=".$tipo_get."'> <button class='btn btn-outline-primary m-md-0 my-md-1 btn-sm m-2'>Ordem alfabética</button></a>
                                                            <a href='showData.php?ordem_cad=1&type=".$tipo_get."'> <button class='btn btn-outline-dark m-md-0 my-md-1 btn-sm m-2'>Ordem de cadastro</button></a>
                                                            
                                                        </div>
                                                    <div class='col-md-9 col-12 p-0 py-4'>
                                                        <div class='container'>
                                                            <div class='row'>
                                                        
                                                ";

                                        while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                            
                                            if($row["email"] == ''){
                                              $row["email"] = "Não possui email";
                                            }

                                            if($row['img_profile'] == ''){
                                                $img = "img-profile-default.jpg";
                                            }else{
                                                $img = $row['img_profile'];
                                            }

                                            $nome = $row['nome'];
                                            $sobrenome = $row['sobrenome'];
                                            $email = $row['email'];
                                            $cria = $row['create_at'];
                                            $id_get = $row['id'];

                                            $res .= "
                                                <div class='container-box'>
                                                    <div class='box-dados-usu'>
                                                        <div class='box-img-usu'>
                                                            <img class='img-fluid' src='../img/{$img}'>
                                                        </div>
                                                        <p class='box-nome-usu'>
                                                            {$nome} {$sobrenome}
                                                        </p>

                                                        
                                                            <p class='box-email-usu'>
                                                                {$email}
                                                            </p>
                                                            <p class='box-cria-usu'>
                                                                Cadastrado em: {$cria}
                                                            </p>
                                                        
                                                        <div class='box-btn-usu'>
                                                            <a href='editar_conta.php?user_id={$id_get}&action=edit'><button class='btn btn-primary btn-sm'>Editar</button></a>
                                                        
                                                        ";

                                                        if($id_get != $id_user_menu){

                                                            $res .= "<a href='../controllers/usuario_controller.php?src={$tipo_get}&user_id={$id_get}&action=delete' class='confirmation btn btn-danger btn-sm'>Excluir</a> ";

                                                        }    
                                            $res.= "                 
                                                        </div>
                                                    </div>
                                                </div>
                                                      ";
                                        }

                                        $res .= "</div> </div> </div> </section>

                                        <!-- Include jQuery - see http://jquery.com -->
                                        <script type='text/javascript'>
                                            $('.confirmation').on('click', function(){
                                                return confirm('Deseja realmente excluir?');
                                            });
                                        </script>
                                                  ";
                                        echo $res;
                                    }else{

                                        $res = "<section class='row'>
                                                    <div class='col-md-3 col-12 px-3 pt-4 text-center'>
                                                       
                                                            Gerenciar contas <br>

                                                            <a href='cad_" . $tipo_get . ".php'> <button class='btn btn-outline-success btn-sm m-md-0 my-md-1 m-2'> + Adicionar</button></a>
                                                            <a href='showData.php?ordem_alfa=1&type=".$tipo_get."'> <button class='btn btn-outline-primary btn-sm m-md-0 my-md-1 m-2'>Ordem alfabética</button></a>
                                                            <a href='showData.php?ordem_cad=1&type=".$tipo_get."'> <button class='btn btn-outline-dark btn-sm m-md-0 my-md-1 m-2'>Ordem de cadastro</button></a>
                                                            
                                                        </div>
                                                    <div class='col-md-9 col-12 p-0 pt-4'>
                                                        <div class='container'>
                                                            <div class='row'>
                                                        
                                                ";


                                        $query2 = "select * from ". $table_name . " " . $ordem;

                                        $stmt2 = $conexao->query($query2);
                                        while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {

                                            $desc = $row["desc_ntc"];
                                            
                                            if (strlen($desc) > 100) {

                                                $stringCut = substr($desc, 0, 100);
                                                $endPoint = strrpos($stringCut, ' ');
                                                $stringCut .= "[...]";
                                                $desc = $stringCut;

                                            }
                                            
                                            $titulo = $row['titulo_ntc'];
                                            $img_noticia = "../img/" . $row['path_img'];
                                            $id_ntc = $row['id_ntc'];

                                            $res .= "
                                                <div class='container-box'>
                                                    <div class='box-dados-usu'>
                                                        <div class='box-img-usu'>
                                                            <img class='img-fluid' src='{$img_noticia}'>
                                                        </div>
                                                        <div class='box-nome-usu'>
                                                            {$titulo}
                                                        </div>
                                                        <div class='box-email-usu'>
                                                            {$desc}
                                                        </div>
                                                        <div class='box-btn-usu pt-2'>
                                                            <a href='editar_news.php?news_id={$id_ntc}&action=edit'><button class='btn btn-primary btn-sm'>Editar</button></a>
                                                            <a href='../controllers/noticia_controller.php?action=delete&news_id={$id_ntc}'><button  class='confirmation btn btn-danger btn-sm'>Excluir</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                      ";
                                        }

                                        $res .= "</div> </div> </div> </section> 
                                        <!-- Include jQuery - see http://jquery.com -->
                                        <script type='text/javascript'>
                                            $('.confirmation').on('click', function () {
                                                return confirm('Deseja realmente excluir?');
                                            });
                                        </script> ";
                                        
                                        echo $res;
                                    }
                                     
                                } else {
                                    echo "Nenhum(a) " .$title_type. "  cadastrado(a) nesta escola";
                                }
                               
                                ?>
                            </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </div>
    
    <?php include '../footer.php'; ?>
    
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>

