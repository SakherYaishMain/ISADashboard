<?php
 
session_start();
require_once'../connections/connect.php';

date_default_timezone_set("America/Chicago");

$date = date("Y/m/d");
$time = date("h:i:sa");

$datetime = $date . ' ' . $time;

$clubname = $_POST['cname'];

$clubhash = md5($clubname);


/////////////////INSERT TO CLUB/////////////////

if(isset($_POST['addclub'])) {


    $sql = "INSERT INTO clubs (clubname, clubhash)  VALUES (?, ?)";
    $stmt = mysqli_stmt_init($link);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL Error";
    } else {
        mysqli_stmt_bind_param($stmt, "ss",  $clubname, $clubhash);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        //header("location:../home.php");
    }


////////////////CHECK IF USER EXITS/////////////////

    $addedby = "Admin";
    $position = "President";
    $pfp = "./images/placeholder.jpg";
    $clearance = 5;
    $clubnameinsert = $clubname . ".";
    $memberemail = $_POST['email'];
    $membernamesign = $_POST['namesign'];
    $membername = $_POST['name'];



    //////////////SIGN USER UP//////////////


    if ($_POST['cpswd'] != "") {
        if ($_POST['pswd'] === $_POST['cpswd']) {
            $hashpswd = md5($_POST['pswd']);
            $sqlcheck = "SELECT * FROM users WHERE email = ?";
            $stmtcheck = mysqli_stmt_init($link);

            if (!mysqli_stmt_prepare($stmtcheck, $sqlcheck)) {
                echo "SQL Error";
            } else {
                mysqli_stmt_bind_param($stmtcheck, "s", $memberemail);
                mysqli_stmt_execute($stmtcheck);
                $resultcheck = mysqli_stmt_get_result($stmtcheck);
                $rowcheck = mysqli_fetch_assoc($resultcheck);
                if (mysqli_num_rows($resultcheck) == 1) {
                    header("location:../createclub.php?error=userexists");
                }else{
                    $sql = "INSERT INTO users (username, password, addedby, position, pfp, clearance, email, clubs)  VALUES (?, ?, ?, ?, ?, ? , ?, ?);";
                    $stmt = mysqli_stmt_init($link);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo "SQL Error";
                    } else {
                        mysqli_stmt_bind_param($stmt, "sssssiss", $membername, $hashpswd, $addedby, $position, $pfp, $clearance, $memberemail, $clubnameinsert);
                        mysqli_stmt_execute($stmt);

                        $result = mysqli_stmt_get_result($stmt);
                        //header("location:../home.php");
                    }

                    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
                    $stmt = mysqli_stmt_init($link);

                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo "SQL Error";
                    } else {
                        mysqli_stmt_bind_param($stmt, "ss", $membername, $hashpswd);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $row = mysqli_fetch_assoc($result);
                        if (mysqli_num_rows($result) == 1) {
                            $userid = $row['userID'];
                        }
                    }

                    $sql3 = "INSERT INTO clearance (userID, level, club) VALUES (?, ?, ?)";
                    $stmt3 = mysqli_stmt_init($link);

                    if (!mysqli_stmt_prepare($stmt3, $sql3)) {
                        echo "SQL Error";
                    } else {
                        mysqli_stmt_bind_param($stmt3, "iis", $userid, $clearance, $clubname);
                        mysqli_stmt_execute($stmt3);
                    }
                }
            }


        } else {
            header("location:../createclub.php?pswddontmatch");
        }

    } else {
        $hashpswd = md5($_POST['pswdsign']);

        $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
        $stmt = mysqli_stmt_init($link);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL Error";
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $membernamesign, $hashpswd);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            if (mysqli_num_rows($result) == 1) {
                $userid = $row['userID'];
                $updatedclubs = $row['clubs'] . "$clubname" . ".";
                $sql2 = "UPDATE users SET clubs = ? WHERE password = ? AND username = ?";
                $stmt2 = mysqli_stmt_init($link);

                if (!mysqli_stmt_prepare($stmt2, $sql2)) {
                    echo "SQL Error";
                } else {
                    mysqli_stmt_bind_param($stmt2, "sss", $updatedclubs, $hashpswd, $membernamesign);
                    mysqli_stmt_execute($stmt2);
                }

                $sql3 = "INSERT INTO clearance (userID, level, club) VALUES (?, ?, ?)";
                $stmt3 = mysqli_stmt_init($link);

                if (!mysqli_stmt_prepare($stmt3, $sql3)) {
                    echo "SQL Error";
                } else {
                    mysqli_stmt_bind_param($stmt3, "iis", $userid, $clearance, $clubname);
                    mysqli_stmt_execute($stmt3);
                }

            }else{
                header("location:../createclub.php?infoincorrect");
            }
        }
    }


    $image = $_FILES['file'];
    if($image['error'] === 4) {
        $imgdest = "./images/placeholder.jpg";
        $sql = "Update clubs SET clubimg = ? WHERE clubname = ?";
        $stmt = mysqli_stmt_init($link);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL Error";
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $imgdest, $clubname);
            mysqli_stmt_execute($stmt);
        }
    }else{
        //$image = $_FILES['file'];
        $fileName = $image['name'];
        $fileTempName = $image['tmp_name'];
        $fileSize = $image['size'];
        $fileError = $image['error'];
        $fileType = $image['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 100000000) {
                    $fileNameNew = $fileName;
                    //$fileNameNew = uniqid('', true). '.' .$fileActualExt;
                    //print($fileNameNew);
                    $fileDestination = '../uploads/' . $fileNameNew;
                    move_uploaded_file($fileTempName, $fileDestination);
                    $imgdest = "./uploads/" . $fileNameNew;

                    $sql = "Update clubs SET clubimg = ? WHERE clubname = ?";
                    $stmt = mysqli_stmt_init($link);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo "SQL Error";
                    } else {
                        mysqli_stmt_bind_param($stmt, "ss", $imgdest, $clubname);
                        mysqli_stmt_execute($stmt);

                        $result = mysqli_stmt_get_result($stmt);



                    }
                    //header("Location:../settings.php");

                } else {
                    echo "File is too big";
                }
            } else {
                echo "An Errpr has occured";
            }
        } else {
            echo "You cannot upload files of this type";
        }
    }


}
header("location:../index.php");
?>


