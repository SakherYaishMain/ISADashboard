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
    <div class="login-box d-flex">
        <div class="left-side-login" style="width:50%;">
            <h2 style="font-weight:600;text-align:center;margin-top:70px;">Please Login</h2>
            <form class="" action="./includes/logininc.php" method="post" style="width:70%;margin:0 auto;margin-top:50px;">
                <label for="username">Username</label><br>
                <input type="text" name="username" value="" placeholder="Username"><br><br>
                <label for="password">Password</label><br>
                <input type="password" name="password" value="" placeholder="Password" ><br><br>
                <a href="index.php?error=forgot">Forgot your password?</a>
                <input type="submit" name="login_user" value="Login" style="margin-top:60px; background:#085646;border:none;color:white;border-radius:10px;">
            </form>
        </div>
        <div class="right-side-login d-flex justify-content-center align-items-center" style="width:50%; background-image:url('./images/aboutus.jpg');background-size:cover;background-position:center; color:white;font-size:50px;">


            <p>ISA Portal</p>
        </div>
    </div>
</div>
<?php require_once"footer.php" ?>
</body>
</html>
