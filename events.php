<?php
 
require_once "./connections/connect.php";
session_start();
$_SESSION['currentpage'] = "events";
?>

<?php
if($_SESSION['clearance']<2 or $_SESSION['clearance'] === "2T" or $_SESSION['clearance'] === "2SM"){
    header("location:home.php");
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Enriqueta:wght@700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/combine/npm/fullcalendar@5,npm/fullcalendar@5/locales-all.min.js,npm/fullcalendar@5/locales-all.min.js,npm/fullcalendar@5/main.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/combine/npm/fullcalendar@5/main.min.css,npm/fullcalendar@5/main.min.css">

</head>
<body style="background:#fafcfe;">
<style>
    footer{
        margin-top:14%;
    }
    #editor form{
        margin-left:30px;
    }
    #editor input{
        width:90%;
    }
</style>
<div class="content d-flex">
    <?php require"nav.php";?>
    <div class="main-content">
        <?php require"uppernav.php";?>
        <h2 style="width:90%;margin:0px auto;font-weight:600;margin-top:150px;font-size:20px;"><?php echo $_SESSION['currentclub'];?></h2>
        <h2 style="width:90%;margin:0px auto;font-weight:600;margin-top:20px;font-size:20px;">Events</h2>
        <div class="center-content flex-wrap justify-content-center" style="width:90%;margin:0px auto;padding-top:50px;">
            <?php
            if($_SESSION['clearance'] > 2){
                echo '<button onclick="displayeventadd()" style=";margin-bottom:30px;padding:5px;color:white;background:#2b2f49;width:150px;height:45px;border-radius:5px;border:none;">Add new Event</button>';
            }
            ?>
            <?php
            if($_SESSION['clearance'] > 2){
                echo '<div id="editor" STYLE="display:none;padding-top:5px;height:300px;padding-right:10px;-webkit-box-shadow: 3px 1px 10px 0px rgba(50, 50, 50, 0.6);-moz-box-shadow:    3px 1px 10px 0px rgba(50, 50, 50, 0.6);box-shadow:         3px 3px 10px 0px rgba(50, 50, 50, 0.6);margin:0px auto;">
                <form method="POST" action="./includes/addeventinc.php">
                <label for="eventname">Event Name</label><br>
                <input type="text" name="eventname" placeholder="Event Name"><br><br>
                <label for="eventstartdate">Event Start Date</label><br>
                <input type="date" name="eventstartdate"><br><br>
                <label for="eventenddate">Event End Date</label><br>
                <input type="date" name="eventenddate"><br><br>
                <input type="submit" value="Submit">
                </form>
            </div>';
            }
            ?>
            <?php
            if($_SESSION['clearance'] > 2){
                echo '<div class="inputagenda d-flex justify-content-center" style="margin-bottom:20px;display:none !important;margin-top:30px;">
                    <input type="submit" id="agendasender" onclick="sendagenda();" style="width:150px;height:40px;background:#2b2f49;color:white;border:none;border-radius:5px;">
                </div>';
            }
            ?>




            <div class="tableagenda" style="overflow: auto;background: white;border-radius: 10px;-webkit-box-shadow: 3px 1px 10px 0px rgba(50, 50, 50, 0.6);-moz-box-shadow:    3px 1px 10px 0px rgba(50, 50, 50, 0.6);box-shadow:         3px 3px 10px 0px rgba(50, 50, 50, 0.6);margin-bottom:30px;">
                <table class="table table-striped" style="overflow: auto">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Date Start</th>
                        <th scope="col">Date End</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT * FROM events WHERE club = ? AND eventType = ? OR eventType = ? ORDER BY dateStart DESC;";
                    $stmt = mysqli_stmt_init($link);
                    $regular = "regular";
                    $all = "admin";
                    

                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo "SQL Statement Failed";
                    }else{
                        mysqli_stmt_bind_param($stmt, "sss", $_SESSION['currentclub'], $regular, $all);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        while($row = mysqli_fetch_array($result)){
                            
                            echo "
                               <tr>
                                    <th scope='row'>".htmlspecialchars($row['eventID'])."</th>
                                    <td>".htmlspecialchars($row['eventName'])."</td>
                                    <td>".$row['dateStart']."</td>
                                    <td>".htmlspecialchars($row['dateEnd'])."</td>
                                </tr>
                            ";

                        }
                    }
                    ?>

                    </tbody>
                </table>
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

<script type="text/javascript">
    function displayeventadd()
    {
        document.getElementById("editor").style.display="block";
        document.getElementsByClassName("inputagenda")[0].style.display="block";
        document.getElementsByClassName("ql-toolbar")[0].style.display="block";

    }
</script>

<?php require_once"footer.php" ?>
</body>
</html>
