<?php //error_reporting(0); // Error Reporting Off
error_reporting(2); // Error Reporting On
session_start();
$servername = "localhost";
$username = "root";
$password = "root";
$db = "nve_management_system";  //NVE database
$conn = new mysqli($servername, $username, $password, $db);
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
define("ADMIN_URL", "http://localhost:8888/NVECMS/Nve/templates/admin3/");
define("ADMIN_URL2", "http://localhost:8888/NVECMS/Nve");
define("PAGI_LIMIT", 30);
date_default_timezone_set("Europe/London");
date_default_timezone_get();
?>