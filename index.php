<?php
session_start(); 
$_SESSION['curPage'] ="index.php";

if(isset($_SESSION['loged'])){
   header("Location: temperature.php");
}else{
   header("Location: login.php");
}



 ?>
