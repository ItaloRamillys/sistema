<div class="container">
    <div id="msg"></div>
    <div class="row">
        <div class="col-12">
            <div class="box"> 
                <header class="div-title-box">
                    <h1 class="title-box-main  d-flex justify-content-center">Gerenciar Administradores</h1>
                </header>
                   
                <div class="table-data">

                <?php 
                    $tabela = "user";
                    $type = "2";

                    $query = "select * from ".$tabela." where type = ".$type;
                        
                    $stmt = $conexao->query($query);

                    if ($stmt->rowCount() > 0) {
                        $has_btn = "";
                        $res = "<section>";

                        $res .= "<table id='tabela-scroll' class='table table-hover'><thead><tr><th>Imagem</th><th class='text-center'>name completo</th><th class='text-center'>Email</th><th class='text-center'>Status</th><th class='text-center'>Ações</th></tr></thead><tbody>";
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                
                            if($row['id'] != $_SESSION['user_id']){
                                $has_btn = "<button class='btn btn-sm m-1'><i class='far fa-trash-alt'></i></button>";
                            }

                                if($row["email"] == ''){
                                  $row["email"] = "Não possui email";
                                }

                    
                                $img = $row['img_profile'];
                                
                                $name = $row['name'];
                                $last_name = $row['last_name'];
                                $email = $row['email'];
                                $cria = $row['create_at'];
                                $id_get = $row['id'];
                                $status = $row['status'];
                                $user = $row['login'];

                                $id_cript_to_del = password_hash($id_get, PASSWORD_DEFAULT, array('cost' => 10));
                                $id_cript_to_up = password_hash($id_get, PASSWORD_DEFAULT, array('cost' => 5));

                                $imagem = render_img(__DIR__."/../../img/".$img, 
                                                    "{$configBase}/../img/".$img,
                                                    "{$configBase}/../img/padrao/img-profile-default.jpg",
                                                    'rounded',
                                                    80,
                                                    80
                                                    );

                                
                                $is_disable = "";
                                if(!$status){
                                    $is_disable = "<button class='btn btn-sm m-1 reactivate' id={$id_cript_to_up} email-data={$email} data-toggle='tooltip' data-placement='top' title='Reativar usuário' {$is_disable}><i class='fas fa-undo'></i></button>";
                                }else{
                                    $is_disable = "<button class='btn btn-sm m-1 disable-btn' id={$id_cript_to_up} email-data={$email} data-toggle='tooltip' data-placement='top' title='Desativar usuário' {$is_disable}><i class='fas fa-times-circle'></i></button>";
                                }

                                $res .= "<tr><td>{$imagem}</td><td class='text-center'> ".$name." ".$last_name." </td><td class='text-center'> ".$email." </td><td class='text-center'> ".$status." </td><td class='text-center'>{$is_disable}<a href='{$configBase}/admin/editar_conta/".$user."' class='btn btn-sm m-1' data-toggle='tooltip' data-placement='top' title='Editar usuário'><i class='fas fa-edit'></i></a></td></tr>";
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
<script src="http://localhost/sistema/js/reactive_user.js"></script>
<script src="http://localhost/sistema/js/disable_user.js"></script>