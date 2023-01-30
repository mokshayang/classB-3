<?php 
session_start();
unset($_SESSION['login']);
header("./index.php");
?>