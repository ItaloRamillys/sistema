<div id="msg"></div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="box"> 
                <header class="div-title-box">
                    <h1 class="title-box-main  d-flex justify-content-center">Gerenciar Professores</h1>
                </header>
               
                <div class="table-data">
                    <input type="hidden" id="tipo" value="1">
                        <?php 

                $tabela = "usuario";
                $tipo = "1";

                $query = "select * from ".$tabela." where tipo = ".$tipo;
                    
                $stmt = $conexao->query($query);

                if ($stmt->rowCount() > 0) {
                    $res = "<section>";

                        $res .= "<table id='tabela-scroll' class='table table-hover'><thead><tr><th>Imagem</th><th class='text-center'>Nome completo</th><th class='text-center'>Email</th><th class='text-center'>Status</th><th class='text-center'>Ações</th></tr></thead><tbody>";
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                
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
                                $user = $row['login'];

                                if(!is_file($configThemePath."/../img/".$img)){
                                    $img = "/usuario/img-profile-default.jpg";
                                }


                                $res .= "<tr><td><img src='{$configBase}/../img/" . $img . "' style='height: 50px; width:50px; border-radius: 50%;'></td><td class='text-center'> ".$nome." ".$sobrenome." </td><td class='text-center'> ".$email." </td><td class='text-center'> 1 </td><td class='text-center'><button class='btn btn-sm btn-danger m-1'><i class='far fa-trash-alt'></i></button><a href='{$configBase}/admin/editar_conta/".$user."' class='btn btn-sm btn-primary m-1'><i class='far fa-edit'></i></a></td></tr>";

                            }

                        $res .= "</tbody></table></section> 
                        <!-- Include jQuery - see http://jquery.com -->
                        <script type='text/javascript'>
                            $('.confirmation').on('click', function () {
                                return confirm('Deseja realmente excluir?');
                            });
                        </script> ";
                        
                        echo $res;
                    } else {
                        echo "Nenhum(a) " .$tabela. "  cadastrado(a) nesta escola";
                    }
                   
                    ?>
                </div>
            </div>
        </div>
    </div>
</div> 
<script src="<?=$configBase?>/../js/delete_usu.js"></script>