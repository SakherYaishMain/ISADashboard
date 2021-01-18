<?php
 
require_once"./connections/connect.php";
session_start();
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
<body style="background:#06003c !important;font-family: 'Enriqueta', serif;">
<style>
    footer{
        color:white !important;
    }
    footer a{
        color:white !important;
    }
    .left-footer{
        width:0px !important;
        height:0px !important;
    }
</style>
<?php
if(isset($_REQUEST['error'])){
    echo '<div class="alert alert-danger alert-dismissible" style="text-align:center;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Passwords Do Not Match Up</strong>
</div>';
}
?>
<div class="pswdchangecontent d-flex align-items-center justify-content-center" style="height:calc(100vh - 30px);background-image: url('./images/abstractbackground.png');background-size: contain">
    <div class="pswdchange" style="width:1000px;height:500px;background:white;-webkit-box-shadow: 5px 5px 15px 5px #000000; box-shadow: 5px 5px 15px 5px #000000;;background: #06003c;">
        <h1 style="text-align: center;margin-top:70px;color:white;">Update Your Password</h1>
        <div style="width:60%;height:3px;background: white; margin: 0px auto;">

        </div>
        <form action="./includes/logininc.php" style="text-align: center;" method="post">
            <input type="text" name="pswd" style="margin-top:50px;width:500px;height:40px;padding-left:5px;" placeholder="Password"><br><br>
            <input type="text" name="confirm_pswd" style="margin-top:10px;width:500px;height:40px;padding-left:5px;" placeholder="Confirm Password"><br>
            <input type="submit" name="change_pswd" style="margin-top:50px;width:400px;height:40px;padding-left:5px;font-weight:bold;font-size:20px;background: #fa1651;border: none;border-radius: 5px;color:white;" value="UPDATE"/>
        </form>
    </div>
</div>
<?php require_once"footer.php" ?>
</body>
</html>

