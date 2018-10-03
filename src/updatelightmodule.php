<?php  include "header.php";

echo "<br />";
echo "Color1: " . $_GET['color1'] . "<br>";
echo "ID:" . $_GET['id'] . "<br>";
echo "Meno:" . $_GET['name'] . "<br>";
echo "Sensor:" .$_GET['mvmsensor']. "<br>";
echo "State:" .$_GET['optradio']. "<br>";

$socketis = new Socket();

$color1 = $_GET['color1'];
$lightState = $_GET['optradio'];
$ID = $_GET['id'];
$name = $_GET['name'];
$MVMsensor = $_GET['mvmsensor'];


   if($lightState == "on") {
	  $lightValue = true;
   } else {
	  $lightValue = 0;
   }

/*INSERT do DB do tabulky riadok1*/
$sql = "UPDATE lightmodules SET LightColor = '$color1', LampOn = '$lightValue' WHERE ID = '$ID'";

	//if ($conn1->query($sql) === TRUE) {
		echo "New record created successfully"."<br>";
		if($MVMsensor === "NULL") {
			$socketis->setLights($name,$lightValue,$color1);
		} else {
			$socketis->assignedMVM($MVMsensor,$name);
		}
		header("Location: lights.php");
//	} else {
//		echo "Error: " . $sql . "<br>" . $conn1->error;
//	}
	$conn1->close();
	
	

?>