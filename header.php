<?php 
include "_inc/functions.php";
include "_inc/dbconnect.php";
include_once "socket.php";
?>

<!DOCTYPE html>
<html lang="sk-SK">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8"> 
    <title>SmartHome</title>
    <meta name="keywords" content="html5, css3">
    <meta name="description" content="">
    <meta name="author" content="Jakub" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
 	
   <!--  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
     -->
    <link rel="stylesheet" href="css/morris.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jqueryMorris.js"></script>
	<script src="js/jQuery.js"></script>
	<script src="js/raphael-min.js"></script>
	<script src="js/morris.min.js"></script>    
   <script src="js/bootstrap.min.js"></script> 
    <script src="js/jscolor.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    
</head>
<?php
	if(isset($_SESSION['loged'])) {    
    $pages = array(     
        'index.php' => 'Teplota',
        'lights.php' => 'Osvetlenie',
        'security.php' => 'Bezpecnost',
        'setting.php' => 'Nastavenia'
                
        );
        $userIsLogin = true;
  }else { 
         $pages = array(       
        );
        $userIsLogin = false;
  } 
        
     if(isset($_SESSION['curPage'])){
         $cur_page =$_SESSION['curPage'];
     }else {
         $cur_page ='';    
     }
?>
<body>
<!-- <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary"> -->
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
<div class="container-fluid">
 <div class="navbar-header">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavBar" >
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="index.php">Smart Home</a>
 </div>
	

  <div class="collapse navbar-collapse" id="myNavBar">
    <ul class="nav navbar-nav mr-auto">
    	<?php foreach ($pages as $pageId => $pageTitle){ ?>
    	    <?php ($cur_page === $pageId)? $varm = 'class="nav-item active"' : $varm = 'class="nav-item"';?>
      	 <li <?php echo $varm ?>>
      		<a class="nav-link" href="<?php echo $pageId ?>"><?php echo $pageTitle?></a>
      	
      	</li>
  			<?php }
         if($userIsLogin) {  			
  			?>
      <?php } ?>
    </ul> 
    
    <ul class="nav navbar-nav navbar-right">
    <?php if($userIsLogin){?>
        <li class="nav-item"><a class="nav-link" href="logoutproces.php"> Odhlas</a></li>
    <?php } else { ?>    
        <li class="nav-item"><a class="nav-link" href="login.php"> Prihlasenie</a></li>
    <?php }  ?>
      </ul> 
  </div>
  </div>
</nav>


<div class="container">
