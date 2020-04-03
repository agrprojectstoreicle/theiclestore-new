<?php 
ob_start(); // Make sure you put this in line 1 with no space
session_start();

$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "icle";


$connection = mysqli_connect($dbservername,$dbusername,$dbpassword,$dbname);

if($connection === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}



?>