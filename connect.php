<?php

$host="localhost";
$user="root";
$pass="";
$db="contacts";
//port for mysql database $port="3306";

$port="8888"
//8888 for apache server local

//i left this comment - $conn = new mysqli($hostname, $username, $password, $dbname, $port);
$conn = mysqli_connect ($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected <br />";
 ?>
