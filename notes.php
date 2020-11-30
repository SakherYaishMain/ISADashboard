<?php
require_once "./connections/connect.php";
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Enriqueta:wght@700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/combine/npm/fullcalendar@5,npm/fullcalendar@5/locales-all.min.js,npm/fullcalendar@5/locales-all.min.js,npm/fullcalendar@5/main.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/combine/npm/fullcalendar@5/main.min.css,npm/fullcalendar@5/main.min.css">

</head>
  <body style="background:#fafcfe;">
    <div class="content d-flex">
        <?php require"nav.php";?>
      <div class="main-content">
          <?php require"uppernav.php";?>
        <h2 style="width:90%;margin:0px auto;font-weight:600;margin-top:150px;font-size:20px;">NOTES</h2>
        <div class="center-content d-flex flex-wrap d-flex justify-content-center" style="width:90%;margin:0px auto;padding-top:50px;">
          <div class="announcement-form" style="margin-top:40px;text-align:center;">
            <form class="" action="./includes/notesinc.php" method="post">
              <textarea name="note" rows="10" cols="80" style="resize:none;background:none;border:2px solid black;padding:10px;"></textarea><br><br>
              <input type="submit" name="" value="Submit" style="width:160px;height:50px;background:#2b2f49;border-radius:10px;border:none;color:white;">
            </form>
          </div>

        </div>
      </div>
    </div>
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

  </body>
</html>
