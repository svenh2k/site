<?php
session_start();

//pull data from login page
$user = $_POST['name'];
$pass = $_POST['password'];

//connect to database
require "connect.php";

//select accounts associated with that employee id and pull relevant data
$sql = "select Name, Password,  from users where Name = " . $user . " ;";
$result = $conn->query($sql);

$row = mysqli_fetch_assoc($result);

//authenticate password (only has one user and password)
if(ltrim($row['Password'], "0") == ltrim($pass, "0")){
require "php_03.php"
} else {
	$goto = "login.html";
	echo "Enter the correct name and password.";
}

header("Location: {$goto}");

 ?>
