<?php
session_set_cookie_params('o', '/', 'localhost/ISAdashboard', isset($_SERVER["HTTPS"]), true);
session_start();
require_once'../connections/connect.php';

$name = $_SESSION['username'];
$userid = $_SESSION['userid'];
$reason = $_POST['note'];
$transid = $_REQUEST['id'];
$transtype = $_POST['transtype'];
$amount = $_POST['amount'];



$sql = "UPDATE finance SET reason = ?, amount = ?, transtype=? WHERE transactionID = ?";
$stmt = mysqli_stmt_init($link);
if(!mysqli_stmt_prepare($stmt, $sql)){
    echo "SQL Error";
}else{
    mysqli_stmt_bind_param($stmt, "sisi", $reason, $amount, $transtype, $transid);
    mysqli_stmt_execute($stmt);
    echo "Done!";
    $result = mysqli_stmt_get_result($stmt);
    header("location:../files.php");

}


?>