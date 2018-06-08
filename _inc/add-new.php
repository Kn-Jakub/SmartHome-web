<?php

include "config.php";

$farba1 = $_POST['color1'];
$farba2 = $_POST['color2'];
$farba3 = $_POST['color3'];
$farba4 = $_POST['color4'];



	
	/*INSERT do DB do tabulky riadok1*/

	$sql = "INSERT INTO riadok1(farba, senzor) VALUES('$farba', '$senzor')";

	if (!empty($_POST['farba']) && !empty($_POST['senzor']) && $conn->query($sql) === TRUE) {
		echo "New record created successfully";
		header("Location: ../index.php");
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
	header("Location: ../index.php");
	
