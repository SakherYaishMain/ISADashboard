<?php
session_set_cookie_params('o', '/', 'https://isadashboard.000webhostapp.com/', isset($_SERVER["HTTPS"]), true);
require_once "./connections/connect.php";
session_start();
require_once './htmlpurifier/library/HTMLPurifier.auto.php';
?>

<?php
if($_SESSION['clearance']<3){
    //header("location:home.php");
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
<div class="content d-flex">
    <?php require"nav.php";?>
    <div class="main-content">
        <?php require"uppernav.php";?>
        <h2 style="width:90%;margin:0px auto;font-weight:600;margin-top:150px;font-size:20px;">FILES</h2>
        <div class="center-content " style="width:90%;margin:0px auto;padding-top:50px;">
            <h5>NOTES</h5><br>
            <a href="edit.php?file=notes"><input type="button" class="editbtn" value="Edit Notes" style="margin-bottom:20px;"/></a>
            <div class="tableagenda" style="overflow: auto;background: white;border-radius: 10px;-webkit-box-shadow: 3px 1px 10px 0px rgba(50, 50, 50, 0.6);-moz-box-shadow:    3px 1px 10px 0px rgba(50, 50, 50, 0.6);box-shadow:         3px 3px 10px 0px rgba(50, 50, 50, 0.6);margin-bottom:30px;">
            <table class="table table-striped" id="tablefinance">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Note</th>
                    <th scope="col">Submitted By</th>
                    <th scope="col">Submitted On</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM notes WHERE club = ? ORDER BY noteID DESC;";
                $stmt = mysqli_stmt_init($link);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    echo "SQL Statement Failed";
                }else{
                    mysqli_stmt_bind_param($stmt, "s", $_SESSION['currentclub']);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    while($row = mysqli_fetch_array($result)){
                        echo "
                               <tr>
                                    <th scope='row'>".htmlspecialchars($row['noteID'])."</th>
                                    <td>".htmlspecialchars($row['note'])."</td>
                                    <td>".htmlspecialchars($row['submittedby'])."</td>
                                    <td>".htmlspecialchars($row['datetimeval'])."</td>
                                    
                                </tr>
                            ";

                    }
                }
                ?>

                </tbody>
            </table>
            </div>
            <div class="divider"></div>
            <h5 style="margin-top:40px;">Announcements</h5><br>
            <input type="button" class="editbtn" value="Edit Announcements" style="margin-bottom:20px;"/>
            <div class="tableagenda" style="overflow: auto;background: white;border-radius: 10px;-webkit-box-shadow: 3px 1px 10px 0px rgba(50, 50, 50, 0.6);-moz-box-shadow:    3px 1px 10px 0px rgba(50, 50, 50, 0.6);box-shadow:         3px 3px 10px 0px rgba(50, 50, 50, 0.6);margin-bottom:30px;">
            <table class="table table-striped" id="tablefinance">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Note</th>
                    <th scope="col">Submitted By</th>
                    <th scope="col">Submitted On</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM announcements WHERE club = ? ORDER BY announcementID DESC;";
                $stmt = mysqli_stmt_init($link);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    echo "SQL Statement Failed";
                }else{
                    mysqli_stmt_bind_param($stmt, "s", $_SESSION['currentclub']);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    while($row = mysqli_fetch_array($result)){
                        echo "
                               <tr>
                                    <th scope='row'>".htmlspecialchars($row['announcementID'])."</th>
                                    <td>".htmlspecialchars($row['announcement'])."</td>
                                    <td>".htmlspecialchars($row['submittedby'])."</td>
                                    <td>".htmlspecialchars($row['datetimeval'])."</td>
                                    
                                </tr>
                            ";

                    }
                }
                ?>

                </tbody>
            </table>
            </div>
            <div class="divider"></div>
            <h5 style="margin-top:40px;">Agendas</h5><br>
            <input type="button" class="editbtn" value="Edit Agendas" style="margin-bottom:20px;"/>
            <div class="tableagenda" style="overflow: auto;background: white;border-radius: 10px;-webkit-box-shadow: 3px 1px 10px 0px rgba(50, 50, 50, 0.6);-moz-box-shadow:    3px 1px 10px 0px rgba(50, 50, 50, 0.6);box-shadow:         3px 3px 10px 0px rgba(50, 50, 50, 0.6);margin-bottom:30px;">
                <table class="table table-striped" style="overflow: auto">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Agenda</th>
                        <th scope="col">Submitted By</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT * FROM agenda WHERE club = ? ORDER BY entryID DESC;";
                    $stmt = mysqli_stmt_init($link);
                    $config = HTMLPurifier_Config::createDefault();
                    $purifier = new HTMLPurifier($config);

                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo "SQL Statement Failed";
                    }else{
                        mysqli_stmt_bind_param($stmt, "s", $_SESSION['currentclub']);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        while($row = mysqli_fetch_array($result)){
                            $clean_html = $purifier->purify($row['message']);
                            echo "
                               <tr>
                                    <th scope='row'>".htmlspecialchars($row['entryID'])."</th>
                                    <td>".htmlspecialchars($row['datetimeval'])."</td>
                                    <td>".$row['message']."</td>
                                    <td>".htmlspecialchars($row['Submittedby'])."</td>
                                </tr>
                            ";

                        }
                    }
                    ?>

                    </tbody>
                </table>
            </div>
            <div class="divider"></div>
            <h5 style="margin-top:40px;">Finances</h5><br>
            <input type="button" class="editbtn" value="Edit Finances" style="margin-bottom:20px;"/>
            <div class="tableagenda" style="overflow: auto;background: white;border-radius: 10px;-webkit-box-shadow: 3px 1px 10px 0px rgba(50, 50, 50, 0.6);-moz-box-shadow:    3px 1px 10px 0px rgba(50, 50, 50, 0.6);box-shadow:         3px 3px 10px 0px rgba(50, 50, 50, 0.6);margin-bottom:30px;">
            <table class="table table-striped" id="tablefinance">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Type</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Reason</th>
                    <th scope="col">Submitted By</th>
                    <th scope="col">Submitted On</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM finance WHERE club = ? ORDER BY transactionID DESC;";
                $stmt = mysqli_stmt_init($link);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    echo "SQL Statement Failed";
                }else{
                    mysqli_stmt_bind_param($stmt, "s", $_SESSION['currentclub']);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    while($row = mysqli_fetch_array($result)){
                        echo "
                               <tr>
                                    <th scope='row'>".htmlspecialchars($row['transactionID'])."</th>
                                    <td>".htmlspecialchars($row['transtype'])."</td>
                                    <td>".htmlspecialchars($row['amount'])."</td>
                                    <td>".htmlspecialchars($row['reason'])."</td>
                                    <td>".htmlspecialchars($row['submittedby'])."</td>
                                    <td>".htmlspecialchars($row['datetimeval'])."</td>
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
<?php require_once"footer.php" ?>
</body>
</html>
