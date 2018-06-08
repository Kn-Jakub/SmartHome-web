<?php 

//display errors
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);


/* Connection to active modules */
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn1 = new mysqli($servername, $username, $password, 'activemodules');
$conn2 = new mysqli($servername, $username, $password, 'servertemperatures');

/* change character set to utf8 */
$conn1->set_charset("utf8");

// Check connection
if ($conn1->connect_error) {
    die("DB1 Connection Failed: " . $conn1->connect_error);
}

/* change character set to utf8 */
$conn2->set_charset("utf8");

// Check connection
if ($conn2->connect_error) {
    die("DB2 Connection Failed: " . $conn2->connect_error);
}
