<?php
session_start(); 
$_SESSION['curPage'] ="index.php";

if(isset($_SESSION['loged'])){
   header("Location: src/temperature.php");
}else{
   header("Location: src/login.php");
}



 ?>
