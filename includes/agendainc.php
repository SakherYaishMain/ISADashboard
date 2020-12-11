<?php
session_set_cookie_params('o', '/', 'localhost/ISAdashboard', isset($_SERVER["HTTPS"]), true);
session_start();
require_once"../connections/connect.php";

$message = $_POST['agendamessage'];

date_default_timezone_set("America/Chicago");

$date = date("Y/m/d");
$time = date("h:i:sa");

$datetime = $date . ' ' . $time;

$username = $_SESSION['username'];

$sql = "INSERT INTO agenda (message, Submittedby, datetimeval, club) VALUES (?,?,?, ?)";
$stmt = mysqli_stmt_init($link);
if(!mysqli_stmt_prepare($stmt, $sql)){
    echo "SQL Error";
}else{
    mysqli_stmt_bind_param($stmt, "ssss", $message, $username, $datetime, $_SESSION['currentclub']);
    mysqli_stmt_execute($stmt);
    echo "Done!";
    $result = mysqli_stmt_get_result($stmt);
    //header("location:../home.php");
}

?>
