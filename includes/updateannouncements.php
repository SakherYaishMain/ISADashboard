<?php
 
session_start();
require_once'../connections/connect.php';

$name = $_SESSION['username'];
$userid = $_SESSION['userid'];
$note = $_POST['note'];
$noteid = $_REQUEST['id'];



$sql = "UPDATE announcements SET announcement = ?, lastupdatedby = ? WHERE announcementID = ?";
$stmt = mysqli_stmt_init($link);
if(!mysqli_stmt_prepare($stmt, $sql)){
    echo "SQL Error";
}else{
    mysqli_stmt_bind_param($stmt, "sii", $note, $userid, $noteid);
    mysqli_stmt_execute($stmt);
    echo "Done!";
    $result = mysqli_stmt_get_result($stmt);
    header("location:../files.php");

}


?>