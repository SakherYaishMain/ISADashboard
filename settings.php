<?php
session_set_cookie_params('o', '/', 'https://isadashboard.000webhostapp.com/', isset($_SERVER["HTTPS"]), true);
require_once"./connections/connect.php";
session_start();
$_SESSION['currentpage'] = "settings";
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Enriqueta:wght@700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/combine/npm/fullcalendar@5,npm/fullcalendar@5/locales-all.min.js,npm/fullcalendar@5/locales-all.min.js,npm/fullcalendar@5/main.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/combine/npm/fullcalendar@5/main.min.css,npm/fullcalendar@5/main.min.css">

</head>
<body style="background:#fafcfe;height:100vh;">
<style>

    #updateinfoform{
        margin-bottom:30px;
    }
</style>
<div class="content d-flex" style="">
    <?php require"nav.php";?>
    <div class="main-content">
        <?php require"uppernav.php";?>
        <h2 style="width:90%;margin:0px auto;font-weight:600;margin-top:150px;font-size:20px;">SETTINGS</h2>
        <div class="center-content d-flex flex-wrap d-flex justify-content-center" style="width:90%;margin:0px auto;padding-top:50px;">
            <div class="left-settings" style="margin-right:100px;">
                <form class="" action="./includes/updateuserinfoinc.php" id="updateinfoform" method="post">
                    <label for="name">Name</label><br>
                    <input type="text" class="changeinfo" name="name" value="<?php echo $_SESSION['username'] ?>" disabled><br><br>
                    <label for="name">Position</label><br>
                    <input type="text" name="position" value="<?php echo $_SESSION['position'] ?>" disabled><br><br>
                    <label for="name">Clearance Level</label><br>
                    <input type="text" name="clevel" value="<?php echo $_SESSION['clearance'];?>" disabled><br><br>
                    <label for="name">Email</label><br>
                    <input type="text" class="changeinfo" name="email" value="<?php echo $_SESSION['email']; ?>" disabled><br><br>
                    <button type="button" name="button" id='editinfo' onclick="updateinfo()" style="background:#2b2f49;color:white;width:150px;height:40px;border:none;border-radius:5px;">Edit</button>
                </form>
            </div>
            <div class="right-settings">
                <img src="<?php echo $_SESSION['pfp']; ?>" alt="" style="width:150px;height:150px;border-radius:50%;"><br><br>
                <form class="" action="./includes/updatepfpinc.php" method="post" enctype='multipart/form-data'>
                    <input type="file" class="custom-file-input" name="file" id="file" style="" onchange="form.submit()"/>
                </form>

            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    function updateinfo(){
        var button = document.getElementById('editinfo');

        if(button.textContent == "Edit"){
            $( ".changeinfo" ).prop( "disabled", false ); //Enable
            button.innerHTML = "Save";
        }

        else{
            button.innerHTML = "Edit";
            //$( ".changeinfo" ).prop( "disabled", true ); //Disable
            document.getElementById('updateinfoform').submit();
        }

    }
</script>
<script type="text/javascript">
    var omak = document.getElementsByClassName('left-side-taskbar');

    function calc()
    {
        if (document.getElementById('checkfml').checked)
        {
            document.getElementsByClassName('left-side-taskbar')[0].style.left = '0px';
        } else {
            document.getElementsByClassName('left-side-taskbar')[0].style.left = '-100%';

        }
    }
</script>
<?php require_once"footer.php" ?>
</body>
</html>
