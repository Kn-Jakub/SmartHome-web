<?php 
session_start();
include "header.php";

?>

<h2>Prihlasenie</h2>
<?php if(isset($_SESSION['msg'])){
   echo $_SESSION['msg'];
} ?>

<form action="loginproces.php" method="post" >
  <div class="container">
    <label for="uname"><b>Pouzivatel</b></label>
    <input type="text" placeholder="Zadajte meno" name="uname" required>

    <label for="psw"><b>Heslo</b></label>
    <input type="password" placeholder="Zadajte heslo" name="psw" required>
        
    <button type="submit">Login</button>
  </div>
</form>

	
	<?php 
include "footer.php";
?>