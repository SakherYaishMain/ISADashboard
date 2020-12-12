<?php
session_set_cookie_params('o', '/', 'https://isadashboard.000webhostapp.com/', isset($_SERVER["HTTPS"]), true);
require_once "../connections/connect.php";
session_start();


if(isset($_REQUEST['code'])){
    $club = $_REQUEST['code'];
    $sql = "SELECT * FROM clubs WHERE clubhash = ?;";
    $stmt = mysqli_stmt_init($link);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "SQL Statement Failed";
    }else{
        mysqli_stmt_bind_param($stmt, "s", $club);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_array($result)){
            $array = explode(".", $_SESSION['clubs']);
            foreach ($array as $fieldclub){
                if($fieldclub == $row['clubname']){
                    $_SESSION['currentclub'] = $row['clubname'];

                    $sql2 = "SELECT * FROM clearance WHERE userID = ? AND club = ?";
                    $stmt2 = mysqli_stmt_init($link);
                    if(!mysqli_stmt_prepare($stmt2, $sql2)) {
                        echo "SQL Statement Failed";
                    }
                    else{
                         mysqli_stmt_bind_param($stmt2, "ss", $_SESSION['userid'], $_SESSION['currentclub']);
                         mysqli_stmt_execute($stmt2);
                         $result2 = mysqli_stmt_get_result($stmt2);
                         while($row2 = mysqli_fetch_array($result2)){
                             $_SESSION['clearance'] = $row2['level'];
                             header("location:../home.php");
                         }
                        }
                    }
                }

            }

        }
        echo $_SESSION['currentclub'];



}else{

    header("location:../home.php");
}



?>