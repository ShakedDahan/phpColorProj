
<?php

$db_host="localhost:3306";
$db_user="shaked";
$db_pass="Sd6696639";
$db_schema="phpdb";


$mysqli=mysqli_connect($db_host,$db_user,$db_pass,$db_schema);

if ($mysqli->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

{}
	


?>