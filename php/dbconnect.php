<?php
ob_start();
session_start();
$siteName = "Cipet.in";
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PSWD', ''); 
DEFINE ('DB_HOST', 'localhost'); 
DEFINE ('DB_NAME', 'proyectofinal'); 

date_default_timezone_set('America/Bogota'); 
$conn =  new mysqli(DB_HOST,DB_USER,DB_PSWD,DB_NAME);
if($conn->connect_error)
die("Failed to connect database ".$conn->connect_error );