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
<body style="background-image: url('./images/wai.png');font-family: 'Enriqueta', serif;background-size: contain">
<style>
    .left-footer{
        width:0px !important;
        height:0px !important;

    }
    input{
        height:35px;
        width:80%;
        padding-left:10px;
    }
    footer{

    }
</style>
<?php
if(isset($_REQUEST['error'])) {
    if ($_REQUEST['error'] == "wrong") {
        echo '<div class="alert alert-danger alert-dismissible" style="text-align:center;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Wrong Username/Password</strong>
</div>';
    }
    if($_REQUEST['error'] == "forgot"){
        echo '<div class="alert alert-danger alert-dismissible" style="text-align:center;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Contact Website Administrator</strong>
</div>';
    }
}
?>
<div class="content d-flex justify-content-center align-items-center content-login" style="height:calc(100vh - 30px);">
    <div class="left-create" style="width: 60%;">
        <div class="createform" style="background-color: rgba(243, 243, 243, 1);padding:0px 30px;border-radius:10px;width:55%;height:700px;margin:0px auto;-webkit-box-shadow: 3px 1px 10px 0px rgba(50, 50, 50, 0.6);-moz-box-shadow: 3px 1px 10px 0px rgba(50, 50, 50, 0.6);box-shadow: 3px 3px 10px 0px rgba(50, 50, 50, 0.6);">
            <h1 style="text-align: center;padding-top:40px;">Create your club!</h1>
            <form action="" method="post">
                <label for="cname">Club Name</label><br>
                <input type="text" name="cname"><br><br>
                <label for="name">Your Name(First and Last)</label><br>
                <input type="text" name="name"><br><br>
                <label for="file">Upload a picture of your club's logo</label><br>
                <input type="file" class="custom-file-input" name="file" id="file" style="padding:0px !important;"/>
                <div class="choose d-flex flex-wrap" style="margin-top:20px;">
                    <input type="button" style="width:50%;background-color: #212529;color:white;border:none;border-right:3px solid white;" value="Already have an account">
                    <input type="button" style="width:50%;background-color: #212529;color:white;border:none;" value="Sign up for an account">
                    <div style="width:100%;background-color: white;margin-top:10px;">
                        <label for="name">Username</label><br>
                        <input type="text" name="name"><br><br>
                        <label for="name">Password</label><br>
                        <input type="pswd" name="name"><br><br>
                    </div>
                    <div style="width:100%; height: 30px; background-color: red; display:none;"></div>
                </div>
            </form>
        </div>
    </div>
    <div class="right-create" style="width: 40%;">
        <img src="./images/man.png" alt="" style="width:80%;height:80%;">
    </div>
</div>
<?php require_once"footer.php" ?>
</body>
</html>
