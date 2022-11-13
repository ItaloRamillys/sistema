<?php 
session_start();
session_unset();
// destroy the session
session_destroy();
header('Location: http://localhost/sistema/index.php');
?>