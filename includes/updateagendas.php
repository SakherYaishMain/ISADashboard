<?php
 
session_start();
require_once'../connections/connect.php';

$name = $_SESSION['username'];
$userid = $_SESSION['userid'];
$agenda = $_POST['agendamessage'];
$agendaid = $_REQUEST['entryid'];



$sql = "UPDATE agenda SET message = ? WHERE entryID = ?";
$stmt = mysqli_stmt_init($link);
if(!mysqli_stmt_prepare($stmt, $sql)){
    echo "SQL Error";
}else{
    mysqli_stmt_bind_param($stmt, "si", $agenda, $agendaid);
    mysqli_stmt_execute($stmt);
    echo "Done!";
    $result = mysqli_stmt_get_result($stmt);


}


?>