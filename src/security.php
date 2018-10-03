<?php 

session_start(); 
$_SESSION['curPage'] ="security.php";
include "header.php" ?>

<h1>Bezpecnost</h1>


<?php
 $initRow;
 
        
 if($initState = $conn1->query("SELECT * FROM activemodules.initialstate ")) {
   if($initState->num_rows > 0) {
      $initRow = $initState->fetch_assoc();        
      ?>

      <form class="securityform" method="get" action="updatesecurity.php">
      <div class="modulyrow">
		<div class="row">
		 <div class="col-sm-3">
		    <b>Režim zabezpečenia: </b>
		 </div>
			<div class="col-sm-3">
			   <label class="radio-inline"><input type="radio" name="optradio" value="active" <?php if($initRow["SecurityState"]){ echo "checked = \"yes\"";} ?> >Aktivna</label>
				<label class="radio-inline"><input type="radio" name="optradio" value="pasive" <?php if(!$initRow["SecurityState"]){ echo "checked = \"yes\"";} ?>>Neaktivna</label>
         </div>
       </div>           
         <div class="row">	
            <div class="col-sm-3">
               <b>Dĺžka reakčného času: </b>
            </div>	
            <div class="col-sm-3">		
				<select class="form-control" id="sel2" name="timesecur">
				  <option value="5"<?php if($initRow['SecurityTime'] == 5){ echo "selected";}?>>5 Sekund</option>
				  <option value="10"<?php if($initRow['SecurityTime'] == 10){ echo "selected";}?>>10 Sekund</option>
				  <option value="20"<?php if($initRow['SecurityTime'] == 20){ echo "selected";}?>>20 Sekund</option>
				  <option value="30"<?php if($initRow['SecurityTime'] == 30){ echo "selected";}?>>30 Sekund</option>
				  <option value="60"<?php if($initRow['SecurityTime'] == 60){ echo "selected";}?>>1 minuta</option>
				  <option value="90"<?php if($initRow['SecurityTime'] == 90){ echo "selected";}?>>1 min 30 sek </option>
				  <option value="120"<?php if($initRow['SecurityTime'] == 120){ echo "selected";}?>>2 min </option>
				  <option value="180"<?php if($initRow['SecurityTime'] == 180){ echo "selected";}?>>3 min </option>
				</select>
				</div>
         </div>
		</div>
		<br>
		
		<div class="row">
		    <input type="submit" name="login" value="Nastav">
      </div>
      
      </form>
   
<?php }
}
 include "footer.php" ?>