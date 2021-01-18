<?php
 
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
<body style="background-image: url('./images/wai.png');font-family: 'Enriqueta', serif;background-size: cover";>
<style>
    .left-footer{
        width:0px !important;
        height:0px !important;

    }
    input{
        height:35px;
        width:95%;
        padding-left:10px;
        background:none;
        border:none;
        border-bottom:1px grey solid;
        color:white;
    }
    footer{
        margin-top:20px;
    }
    .custom-file-input::before {
        content: 'Upload a picture';
        color: black !important;
        display: inline-block;
        background: -webkit-linear-gradient(top, #ffffff, #ffffff) !important;
        border: 1px solid #999;
        border-radius: 3px;
        padding: 8px 15px;
        -webkit-user-select: none;
        cursor: pointer;
        width: 150px;
        height:40px;
        background: #2b2f49;
        border:none !important;
        border-bottom:none !important;
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
<div class="content d-flex justify-content-center align-items-center content-login createclubcontent" style="color:white;">
    <div class="central-form d-flex" style="background-color: rgba(43,47,73,1);padding:0px 30px;border-radius:10px;width:55%;margin:0px auto;-webkit-box-shadow: 3px 1px 10px 0px rgba(50, 50, 50, 0.6);-moz-box-shadow: 3px 1px 10px 0px rgba(50, 50, 50, 0.6);box-shadow: 3px 3px 10px 0px rgba(50, 50, 50, 0.6);padding-right:5px;margin-top:60px;">
    <div class="left-create" style="width: 50%;padding-right:30px;">
        <div class="createform" style="">
            <h1 style="text-align: center;padding-top:40px;">Create your club!</h1>
            <form action="./includes/addclub.php" method="post" style="margin-top:30px;" enctype='multipart/form-data'>
                <label for="cname">Club Name(No special characters)</label><br>
                <input type="text" placeholder="Enter the club's name" name="cname" style="margin-bottom:20px;" pattern="[A-Za-z]{1,}" title="Can't include special characters">
                <label for="name" style="">Your Name(First and Last)</label><br>
                <input type="text" placeholder="Enter your name" name="name" style=""><br><br>
                <label for="file">Upload a picture of your club's logo</label><br>
                <input type="file" class="custom-file-input" name="file" id="file" style="padding:0px !important;border:none !important;"/>
                <div class="choose d-flex flex-wrap" style="margin-top:20px;">
                    <input type="button" onclick="show('alreadyhave','signup')" style="padding: 0px;width:47.5%;background-color: #ffffff;color:black;border:none;border-right:3px solid black;margin-top:10px;" value="Already have an account">
                    <input type="button" onclick="show('signup', 'alreadyhave')" style="padding: 0px;width:47.5%;background-color: #ffffff;color:black;border:none;margin-top:10px;" value="Sign up for an account">
                    <div id="alreadyhave" style="width:100%;margin-top:10px; display: block">
                        <h5>Sign In</h5>
                        <label for="name" style="margin-top:20px;">Username</label><br>
                        <input type="text" name="namesign" placeholder="Enter your username"><br><br>
                        <label for="name">Password</label><br>
                        <input type="password" name="pswdsign" placeholder="Enter your password"><br><br>
                    </div>
                    <div id="signup" style="width:100%; margin-top:10px;display:none;">
                        <h5>Sign Up</h5>
                        <label for="name" style="margin-top:20px;">Username</label><br>
                        <input type="text" name="name"><br><br>
                        <label for="email" style="">Email</label><br>
                        <input type="text" name="email"><br><br>
                        <label for="name">Password</label><br>
                        <input type="password" name="pswd"><br><br>
                        <label for="cpswd">Confirm Password</label><br>
                        <input type="password" name="cpswd"><br><br>
                    </div>
                    <input type="submit" value="Submit" name="addclub" style="border:1px solid grey !important;background:#ffffff;color:black;height:40px;border-radius:10px;margin-bottom:30px;">
                </div>
            </form>
        </div>
    </div>
        <div class="right-create" style="width: 50%;">
            <img src="./images/man.png" alt="" style="width:100%;height:100%;object-fit: contain">
        </div>
    </div>

</div>
<?php require_once"footer.php" ?>
<script type="text/javascript">
    function show(show, hide){
        var div1 = document.getElementById(show);
        var div2 = document.getElementById(hide);

        div1.style.display = "block";
        div2.style.display = "none";
    }
</script>
</body>
</html>
