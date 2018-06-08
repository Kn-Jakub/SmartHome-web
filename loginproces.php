<?php
session_start();
include "_inc/dbconnect.php";

$name = $_POST['uname'];
$password = $_POST['psw'];
$sqlcommand = "SELECT * FROM login WHERE id = 1 ";

$_SESSION['loged'] = true;

$dbRow = $conn1->query($sqlcommand);
if($dbRow->num_rows > 0) {
   $logRow = $dbRow->fetch_assoc();
   $dbName = $logRow['Name'];
   $dbPass = $logRow['Password'];    
   echo $dbName . "  " . $dbPass ;  
   if(($dbName === $name) && ($dbPass === $password)){
      $_SESSION['loged'] = true;
      header("Location: index.php");
   } else {
      $_SESSION['msg'] = "Zadali ste nesprávne heslo alebo používateľské meno!";
      header("Location: login.php");
   }
}


?>