<?php
 
session_start();
require_once'../connections/connect.php';
//$_SESSION['image'] = $_FILES['file'];

$image = $_FILES['file'];
        //$image = $_FILES['file'];
        $fileName = $image['name'];
        $fileTempName = $image['tmp_name'];
        $fileSize = $image['size'];
        $fileError = $image['error'];
        $fileType = $image['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if(in_array($fileActualExt, $allowed)){
          if($fileError === 0){
            if($fileSize < 100000000){
              $fileNameNew = $fileName;
              //$fileNameNew = uniqid('', true). '.' .$fileActualExt;
              //print($fileNameNew);
              $fileDestination = '../uploads/' .$fileNameNew;
              move_uploaded_file($fileTempName, $fileDestination);
              $imgdest = "./uploads/".$fileNameNew;
              echo $imgdest;
              $userid = $_SESSION['userid'];
              echo $userid;
                $sql = "Update users SET pfp = ? WHERE userID = ?";
                $stmt = mysqli_stmt_init($link);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    echo "SQL Error";
                }else{
                    mysqli_stmt_bind_param($stmt, "si", $imgdest, $userid);
                    mysqli_stmt_execute($stmt);
                    echo "Done!";
                    $result = mysqli_stmt_get_result($stmt);
                    $_SESSION['pfp'] = $imgdest;


                }
              header("Location:../settings.php");

            }else{
              echo "File is too big";
            }
          }else{
            echo "An Errpr has occured";
          }
        }else{
          echo "You cannot upload files of this type";
        }


 ?>
