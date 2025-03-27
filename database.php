<?php
$servername = "localhost";
$username = "root";
$password = "";
$DBname = "register";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $DBname);

// Check connection
if (!$conn) {
    die("Connection Failed. Try again later");
  }
?>