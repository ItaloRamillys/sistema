<?php 
session_start();
// destroy the session
session_destroy();

header('Location: http://localhost/sistema/index.php');

?>