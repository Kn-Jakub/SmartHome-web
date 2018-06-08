<?php

/* SELECT z DB servertemperatures */
function temperatures($conn) {
	$sensorname = $conn->query("SELECT SensorName FROM activemodules.temperaturemodule");
	while($row = $sensorname->fetch_assoc()) {
			echo '<div class="clearfix"><b>' . "Senzor: " . $row["SensorName"] . '</b></div><br /><hr>';
			$row = $row["SensorName"];
			$sensorvalues = $conn->query('SELECT * FROM servertemperatures. '. $row .' limit 10');
			while($row2 = $sensorvalues->fetch_assoc()) {
				echo '<div class="col-6 col-md-4">';
				echo "ID:" . $row2["ID"] . "<br />";
				echo "Date:" . $row2["Date"] . "<br />";
				echo "Time:" . $row2["Time"] . "<br />";
				echo "Temperature:" . $row2["Temperature"] . "<br />";
				echo "Humidity:" . $row2["Humidity"] . "<br />";
				echo "<hr>";
				echo "</div>";
				}
		}
	
		
}



