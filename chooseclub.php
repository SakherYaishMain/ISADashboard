<?php
session_set_cookie_params('o', '/', 'https://isadashboard.000webhostapp.com/', isset($_SERVER["HTTPS"]), true);
require_once "./connections/connect.php";
session_start();


if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    //header("location: login.php");
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css<?php echo '?'.mt_rand(); ?>" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous"><link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Enriqueta:wght@700&display=swap" rel="stylesheet">
</head>
<body style="background-image: url('./images/abstractbackground.png');font-family: 'Enriqueta', serif;">
<style>
    .left-footer{
        width:0px !important;
        height:0px !important;
    }
</style>
<div class="content d-flex justify-content-center align-items-center content-login" style="height:calc(100vh - 30px);">
    <div class="chooseclub d-flex justify-content-around flex-wrap" style="-webkit-box-shadow: 3px 1px 10px 0px rgba(50, 50, 50, 0.6);-moz-box-shadow: 3px 1px 10px 0px rgba(50, 50, 50, 0.6);box-shadow: 3px 3px 10px 0px rgba(50, 50, 50, 0.6);width:1200px;height:600px;background:white;padding:20px;align-items:center;overflow-y:auto;">

        <?php
         $clubs = explode(".", $_SESSION['clubs']);
        foreach ($clubs as $field){
            $sql = "SELECT * FROM clubs WHERE clubname = ?;";
            $stmt = mysqli_stmt_init($link);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                echo "SQL Statement Failed";
            }else{
                mysqli_stmt_bind_param($stmt, "s", $field);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while($row = mysqli_fetch_array($result)){
                    echo '<a href="./includes/setclubstatus.php?code='.$row['clubhash'].'" style="color:black;">
                <div class="clubcard" style="height:300px;width:200px;-webkit-box-shadow: 3px 1px 10px 0px rgba(50, 50, 50, 0.6);-moz-box-shadow: 3px 1px 10px 0px rgba(50, 50, 50, 0.6);box-shadow: 3px 3px 10px 0px rgba(50, 50, 50, 0.6);">
                <h2 style="text-align:center;margin-top:10px;">'.$row['clubname'].'</h2>
                <img src="'.$row['clubimg'].'" style="margin-top:10px;width:150px;height:150px;margin-left:25px;">
        </div></a>
            ';
                }
            }

        }
        ?>


    </div>
</div>
<?php require_once"footer.php" ?>
</body>
</html>
