<?php
/*
Copyright (c) 2013, Olly Smith
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:

1. Redistributions of source code must retain the above copyright notice, this
list of conditions and the following disclaimer.
2. Redistributions in binary form must reproduce the above copyright notice,
this list of conditions and the following disclaimer in the documentation
and/or other materials provided with the distribution.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.*/
session_start();
$_SESSION['curPage'] ="index.php";
include "header.php" ?>

<h1>Teplota</h1>
<div class="tmprow>">
<div class="row">

			<div class="col-sm-4">
			
<?php

$actualModuleName = "";
$newrow;
$onlyActive = true;
$sqlcommand = "";
if($onlyActive){
   $sqlcommand = "SELECT SensorName FROM activemodules.temperaturemodules WHERE State = 1" ;
   ?>
         <h3>Aktívne senzory</h3>
   <?php
} else {
   $sqlcommand = "SELECT SensorName FROM activemodules.temperaturemodules" ;
   ?>
         <h3>Senzory v databaze</h3>
			
   <?php
}
if(isset($_GET['tmpsensors'])){
         $variable = $_GET['tmpsensors'];
         $actualModuleName = $variable;	
      }  
/* Dáta pre graf - zobrazenie casu, teploty, vlhkosti pre aktivny modul v grafe */
if($sensorname = $conn1->query($sqlcommand)) {
   if($sensorname->num_rows > 0) {?>
   <form class="moduleformreload" method="get" action="temperature.php">
    <div class="row">
    <div class="col-sm-8">
    <!-- <div class="list-group" id="tmpsensor"> -->
    <select class="form-control" id="tmpsensors" name="tmpsensors">
    <?php
	  while($row = $sensorname->fetch_assoc()) { 
	  $newrow = $row["SensorName"];
	     if(!isset($_GET['tmpsensors'])){
            $actualModuleName = $newrow;	
         }
	  ?>
     <?php $vvvv = ($newrow === $actualModuleName) ? '"'.$newrow.'"'.' selected':'"'.$newrow.'"';?>
	 <!-- <a href="#" class="list-group-item"><?php echo $newrow; ?></a> -->
	  <option value="<?php echo $newrow; ?>" label=<?php echo $vvvv;?>><?php echo $newrow; ?></option>
     
       
      <?php }      ?>
      </select>
		</div>
		
		
		<div class="col-sm-4">
      <input type="submit" name="sentactualtime" size="10" value="Reload ">
     </div>
     </div>
     </form>
      <br>
      <form class="moduleform" method="get" action="updatetemperature.php">
      <div class="row">
      <label for="tmpperiod">
      <b>Perióda odosielania dát:</b> 
      </label>     
      </div>      
      <div class="row">
      <div class="col-sm-6">
         <select class="form-control" id="tmp1" name="tmpperiod">
           <option value="10">10 Sekund</option>	  
   	     <option value="20">20 Sekund</option>	
   	     <option value="40">40 Sekund</option>	
   	     <option value="60">1 Minuta</option>	
   	     <option value="120">2 Minuty</option>	
   	     <option value="300">5 Minut</option>
   	     <option value="600">10 Minut</option>	
   	     <option value="1800">30 Minut</option>	
   	     <option value="3600">1 Hodina</option>	
   	     <option value="7200">2 Hodiny</option>
   	     <option value="21600">6 Hodin</option>	
   	     <option value="43200">12 Hodin</option>			
	      </select>
	        <?php
               			
				?>
	      
      </div>
      <div class="col-sm-2"></div>
      <div class="col-sm-4">
         <input type="submit" name="sendtmpPeriod"  value="Nastav ">
         <input  name="actualmodulename" type="hidden" value="<?php echo $actualModuleName; ?>">
      </div>   
      </div>
      </form>
	  </div>
	  
			<div class="col-sm-8">
				<h3>Graf</h3>
				<strong>Pre modul:  </strong> &nbsp;&nbsp;
				<em><?php echo $actualModuleName; ?></em>
				<div id="chart" style="height: 250px;"></div>
						<?php
						//if($sensorvalues = $conn1->query('SELECT * FROM servertemperatures.'. $newrow .' ORDER BY ID DESC LIMIT 50')){     
            			if($sensorvalues = $conn1->query('SELECT * FROM servertemperatures.`'. $actualModuleName.'`  LIMIT 50')){
            			  $num_rows = $sensorvalues->num_rows;
            			  if($num_rows < 10){
            			     $numberReduction = 1;
            			  }else{
            			      $numberReduction = $num_rows/20;
                        }            			  
            			  $counter = 1;
							  $chart_data = "";?>
							 <div id="chart" style="height: 250px;"></div>
							  <div id="chart2" style="height: 250px;"></div> 
							  <?php
							  if($sensorvalues->num_rows > 0) {
						         while($row2 = $sensorvalues->fetch_assoc()) {
						            if(($counter % $numberReduction) == 0) {
							          // echo "ID:" . $row2["ID"] ." /" . $row2["Epoch"] ." /tep: " . $row2["Temperature"] ." /hum: " . $row2["Humidity"] . "<br />";
							          // $chart_data .= "{ Epoch: '".$row2["Epoch"] ."', Temperature: '".$row2["Temperature"]."', Humidity: '".$row2["Humidity"]."' },";
							           $chart_data .= "{ Epoch: '".$row2["Epoch"] ."', Temperature: '".$row2["Temperature"]."', Humidity: '".$row2["Humidity"]."' },";
							           
				                  }
				                  $counter++;
						         }
						         //$chart_data = "{ Epoch: '2018-05-06T16:36:19Z', Temperature: '15.93' },{ Epoch: '2018-05-06T17:36:39Z', Temperature: '18.93' },{ Epoch: '2018-05-06T18:36:59Z', Temperature: '29.43' },{ Epoch: '2018-05-06T19:37:19Z', Temperature: '34.68' },{ Epoch: '2018-05-06T20:37:17Z', Temperature: '34.68' },{ Epoch: '2018-05-06T21:37:59Z', Temperature: '34.68' }"; 
						        // echo $chart_data;
               		 } else {
               		    echo "Dany senzor nema v databaze ziadne hodnoty". "<br />"; 
               		 }	
               		 ?>
               		 </div>
               		 <?php
               	}else{
               	  echo "K senzoru neprislucha ziadna tabulka databazy". "<br />"; 
               	}				
						     ?>

			
			
			
		
	<?php  
   }else {
      echo "V databaze sa nenachadza ziaden senzor". "<br />";   
   }
} else {
   echo "Nie je vytvorena dana tabulka v MYSQL, na server sa zatial nepripojil ziaden senzor". "<br />";
}	
	?>
</div>
</div>
<?php include "footer.php" ?>

<script>
new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'chart',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.   data: [ <?php echo $chart_data ?> ],
  data: [ <?php echo $chart_data ?> ],
  // The name of the data record attribute that contains x-values.
  xkey: 'Epoch',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['Temperature', 'Humidity' ],
  // Labels for the ykeys -- will be displayed when you hover over the chart.
  labels: ['Temperature', 'Humidity'],
  //xLabels: ["30sec"],
  pointSize:[2],
  hoverCallback: function (index, options, content) {
     var row = options.data[index];
     content = "<div class='morris-hover-row-label'>" + row.Epoch + "</div>";
      content += "<div class='morris-hover-point' style='color: #0b62a4'>\n  Temperature:\n  " + row.Temperature + " °C\n</div>";
      content += "<div class='morris-hover-point' style='color: #7a92a3'>\n  Humidity:\n  " + row.Humidity + " %\n</div>";
      return content;
     
   },
  hideHover:[true],
  smooth:[true],
  postUnits:[' °C[%]'],
  //axes:[true],
  grid:[true],
  //dateFormat: [function (x) {return new Date(x).toString(); }]
});

</script>

<?php $conn1->close(); ?>