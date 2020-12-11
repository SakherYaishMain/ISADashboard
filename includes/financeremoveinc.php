<?php
session_set_cookie_params('o', '/', 'localhost/ISAdashboard', isset($_SERVER["HTTPS"]), true);
require_once "../connections/connect.php";
session_start();

date_default_timezone_set("America/Chicago");

$date = date("Y/m/d");
$time = date("h:i:sa");

$datetime = $date . ' ' . $time;

$amount = $_POST['amount'];
$reason = $_POST['reason'];
$submittedby = $_SESSION['username'];
$transtype = "Expense";

$sql = "INSERT INTO finance (amount, reason, submittedby, datetimeval, transtype, club) VALUES (?, ?, ?, ?, ?, ?);";
$stmt = mysqli_stmt_init($link);
if(!mysqli_stmt_prepare($stmt, $sql)){
    echo "SQL Error";
}else{
    mysqli_stmt_bind_param($stmt, "isssss", $amount, $reason, $submittedby, $datetime, $transtype, $_SESSION['currentclub']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    header("location:../finance.php");

}

?>