<?php 
session_start();
include_once("proj_esc_func/connection.php"); 
$conn = new Connection();
$conn = $conn->connect();


$user = strip_tags(trim($_POST['user']));
$pass = strip_tags(trim($_POST['pass']));
if((isset($user)) && (isset($pass))){
    $query_login = "select * from user WHERE binary login = ? && binary pass = ?";

    $stmtLogin = $conn->prepare($query_login);
    $stmtLogin->execute([$user, $pass]);
    $row = $stmtLogin->fetch(PDO::FETCH_ASSOC);

    $type    = $row['type'];
    $id_usu  = $row['id'];

    if($row){
        $_SESSION['time_login'] = time();
        $_SESSION['style'] = "theme_1.css";
        $_SESSION['user_id'] = $id_usu;
        $_SESSION['verify'] = true;
        $_SESSION['type'] = $type;
        $_SESSION['login'] = $row['login'];
        $_SESSION['genre'] = $row['genre'];
        $_SESSION['user_name'] = $row['name'] . " " . $row['last_name'];

        $_SESSION['count_operations_db'] = 0;

        header("Location: painel");
    }else{
        header("Location: http://localhost/sistema/index.php?login=erro");
    }
}else{
    header("Location: http://localhost/sistema/index.php?login=erro");
}
?>
 
