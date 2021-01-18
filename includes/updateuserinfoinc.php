<?php
 
session_start();
require_once'../connections/connect.php';

$name = $_POST['name'];
$email = $_POST['email'];
$userid = $_SESSION['userid'];
echo $name;
echo $email;
echo $userid;


$sql = "UPDATE users SET username = ?, email = ? WHERE userid = ?";
$stmt = mysqli_stmt_init($link);
if(!mysqli_stmt_prepare($stmt, $sql)){
    echo "SQL Error";
}else{
    mysqli_stmt_bind_param($stmt, "ssi", $name, $email, $userid);
    mysqli_stmt_execute($stmt);
    echo "Done!";
    $result = mysqli_stmt_get_result($stmt);
    $_SESSION['username'] = $name;
    $_SESSION['email'] = $email;
    header("location:../settings.php");

}


?>