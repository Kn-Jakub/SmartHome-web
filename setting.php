<?php
session_start(); 
$_SESSION['curPage'] ="setting.php";
 include "header.php" ?>

<h1>Nastavenia</h1>

<?php 
   $logLevels = array(
      'fatal' => 'Fatal',
      'error' => 'Error',
        'warning' => 'Warning',
        'info' => 'Info',
        'debug' => 'Debug',
        'trace' => 'Trace',
        'all' => 'All');
 $initRow;       
 if($initState = $conn1->query("SELECT * FROM activemodules.initialstate ")) {
   if($initState->num_rows > 0) {
      $initRow = $initState->fetch_assoc();        
      ?>


      <div class= "col-sm-6">
		<form class="moduleform" method="get" action="updatesetting.php">
		<div class="row">
			<div class="col-sm-6">
			<strong>Log level:</strong>
			</div>
			<div class="col-sm-6">
			<select class="form-control" name="loglevel"  >
			<?php foreach ($logLevels as $value => $label) {
			    $hlabel = ($value === $initRow["LogLevel"]) ? '"'.$label.'"'.' selected':'"'.$label.'"';
			    var_dump( $hlabel);
			   ?>
			
			<option value= "<?php echo $value; ?>" label=<?php echo $hlabel;?>><?php echo $label; ?></option> 
					
			<?php } ?>
			</select> 
			
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<strong>Perioda automatickeho zapalovania svetla: </strong>
			</div>
			<div class="col-sm-6">
			   <div class="col-sm-9 timeperiod">
				  <input type="number" name="timeperiod" value="<?php echo $initRow["SvetloPerioda"];?>" ></input>
         	</div>
         	<div class="col-sm-3">			
				  <!-- sekúnd -->
				</div>  
			</div>
			
		</div>
		<hr>
		<div class="row">
		    <div class="col-sm-1">
			    <input type="submit" name="setOption" value="Uloz"></input>
			 </div>
		</div>
		
		</form>
		<div class="row">
			
		</div>
		</div>
		<div class= "col-sm-6">
<h3>Informacie o servery</h3>
<hr>
<h4>Pridelenie portov:</h4>
   Teplota: 10003/10007<br>
   Osvetlenie: 10004<br>
   Pohyb: 10005<br>
   Dvere:&nbsp;10006<br>
   
   </div>
<?php
   }
}

   
 include "footer.php" ?>
