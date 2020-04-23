
<div class='container-box' id='login' style='display: none'>
    <div class='box-login' id='box'>
        <div class='box-login-transparent'>
            <div class='row p-2'> 

                <h2 class='col-10 mb-2'><i class='fas fa-user'></i>  Login </h2>
                <div style='display: flex; justify-content: center; align-items: center; cursor: pointer; width: 30px; height: 30px; background-color:#c33030; border-radius: 50%;'  id='close-login'>
                    <i class='fa fa-close'></i> 
                </div>

            </div>
            <form method='POST' action='validate.php'>
                <div class='inputBox'>
                    <input type='text' name='user' id="user" required='' autocomplete='disabled'>
                    <label>Login</label>
                </div>
                <div class='inputBox'>
                    <input type='password' name='pass' id="pass" required=''>
                    <label>Senha</label>
                </div>
                    <?php
                        if(isset($_GET['login']) && $_GET['login'] == 'erro'){
                            
                            echo "<div class='error-message'>Usuário ou senha inválido(s)</div>";

                            ?> 
                        <?php

                        }else if(isset($_GET['login']) && $_GET['login'] == 'erro2') {
                            echo "<div class='error-message'>Por favor realize o login no sistema</div>";
                        }
                    ?>
                <input type='submit' class='btn btn-primary' name='' value='Entrar'>
            </form>
        </div>
    </div>
</div>

