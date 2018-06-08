<?php
session_start(); 
$_SESSION['curPage'] ='lights.php';
include "header.php"; ?>

<h1>Osvetlenie</h1>
<div class="row">

<div class="col-sm-8">
        <h3>Aktívne moduly</h3>
<?php

/* SELECT z DB aktivnemoduly */

$sql = "SELECT * FROM lightmodules WHERE State = 1";
$result = $conn1->query($sql);			
	if ($result->num_rows > 0) {
		// output data of each row	?>		
		
		<?php while($row = $result->fetch_assoc()) { 
		?>   
              <div class="modulyrow">
               <div>	
              <h5><strong>
              <?php echo $row["SensorName"];
              $assignedSensor = $row["MVMSensor"];             
              ?> 
              </strong></h5>
              </div>
              
              <div class="row">
              
                  <form class="moduleform" method="get" action="updatelightmodule.php">
                  <div class="col-sm-3 colorsquare">
              		     <!-- <li class="list-group-item"> --> <input name="color1" class="jscolor"  value=" <?php echo $row['LightColor']; ?> "> <!-- </li> -->
                  </div>
					    <div class="col-sm-3 mvmsensorselect">					 
					    <div class="form-group">
					  
  						    <select class="form-control" id="sel1" name="mvmsensor">
  							      <?php
							     /* SELECT z DB mvm sensors */
							     $autoLight = false;
							     $sql = "SELECT * FROM mvmmodules WHERE State = 1";
							     $resultHelp = $conn1->query($sql);			
							     if ($resultHelp->num_rows > 0) {
								    // output data of each row	
								       if($assignedSensor === "") {
								          $autoLight = false;?>	
							        <option value="NULL" selected>Senzor Nepriradeny</option>
							    <?php }else{ ?>
							         <option value="NULL">Senzor Nepriradeny</option>
							         
							    <?php $autoLight = true;} ?>     
								    <?php while($row3 = $resultHelp->fetch_assoc()) { 
                                    if($assignedSensor === $row3["SensorName"]) {								    
                                       $autoLight = true;								    
								    ?>    
   						            <option  value="<?php echo $row3['SensorName']; ?> " selected><?php echo $row3["SensorName"]; ?></option>
    						        <?php }else{ ?>
    						           <option  value="<?php echo $row3['SensorName']; ?> "><?php echo $row3["SensorName"]; ?></option>
    						        
    							    <?php 
    							    }  }
    						     } else {?>
								    <option value="NULL">Ziaden senzor</option>
							     <?php }?>
  						    </select>
					    </div> 					
					    </div>            
              
                   <li class="list-group-item"> <input name="id" type="hidden" value=" <?php echo $row["ID"]; ?> "> </li> 
                   <li class="list-group-item"> <input name="name" type="hidden" value=" <?php echo $row["SensorName"]; ?> "> </li>
                   <div class="col-sm-3">
                        
               	      <label class="radio-inline lightstate"><input type="radio" name="optradio" value="on" <?php if($row["LampOn"] && !$autoLight){ echo "checked = \"yes\"";} ?> >On</label>
						      <label class="radio-inline lightstate"><input type="radio" name="optradio" value="off" <?php if(!$row["LampOn"]&& !$autoLight){ echo "checked = \"yes\"";} ?>>Off</label>
						      <label class="radio-inline lightstate"><input type="radio" name="optradio" value="auto" <?php if($autoLight){ echo "checked = \"yes\"";} ?>>Auto</label>
				        </div>
				        <div class="col-sm-3 rightInput">
              		      <li class="list-group-item submit"> <input type="submit" value="Potvrd"></li>
                   </div>
                </form>
              </div> 
              </div>
          
		<?php }?>
	

			
		<?php } else {
	echo "Ziadne";
} ?>
</div>
<div class="col-sm-4">
       <h3>Neaktívne moduly</h3>
            
<?php
/* SELECT z DB neaaktivnemoduly */
$sql = "SELECT * FROM lightmodules WHERE State = 0";
$result = $conn1->query($sql);			
	if ($result->num_rows > 0) {
		// output data of each row	?>		
			
			
			
			<?php while($row = $result->fetch_assoc()) { ?>
			
			<div class="modulyrow">		
            <ul class="list-group ulneaktivne">
                 <li class="list-group-item col-sm-6"> <?php echo $row["SensorName"]; ?> </li>
                 <li class="list-group-item col-sm-6"> <?php echo $row['LastActivity']; ?> </li>
            </ul>	 
			</div>	
					
			<?php }?>
			
            
			
		<?php } else {
	echo "Ziadne";
}?>
</div>	
</div>     
			