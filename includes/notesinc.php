<?php
session_set_cookie_params('o', '/', 'localhost/ISAdashboard', isset($_SERVER["HTTPS"]), true);
session_start();
require_once'../connections/connect.php';

date_default_timezone_set("America/Chicago");

$date = date("Y/m/d");
$time = date("h:i:sa");

$datetime = $date . ' ' . $time;

echo $datetime;

$name =  $_SESSION['username'];

$ann = $_POST['note'];

$sql = "INSERT INTO notes (note, datetimeval, submittedby)  VALUES (?, ?, ?)";
$stmt = mysqli_stmt_init($link);
   if(!mysqli_stmt_prepare($stmt, $sql)){
     echo "SQL Error";
   }else{
     mysqli_stmt_bind_param($stmt, "sss", $ann, $datetime, $name);
     mysqli_stmt_execute($stmt);
     echo "Done!";
     $result = mysqli_stmt_get_result($stmt);
     header("location:../home.php");
   }

 ?>
