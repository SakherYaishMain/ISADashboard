<?php
session_set_cookie_params('o', '/', 'https://isadashboard.000webhostapp.com/', isset($_SERVER["HTTPS"]), true);
require_once "./connections/connect.php";
session_start();
require_once './htmlpurifier/library/HTMLPurifier.auto.php';
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
    <link href="https://cdn.quilljs.com/1.3.4/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.4/quill.js"></script>


</head>
<body style="background:#fafcfe;">
<style>

    .ql-editor li{
        padding-left:0px !important;
    }
</style>
<div class="content d-flex">
    <?php require"nav.php";?>
    <div class="main-content">
        <?php require"uppernav.php";?>
        <h2 style="width:90%;margin:0px auto;font-weight:600;margin-top:150px;font-size:20px;">EDIT</h2>
        <div class="center-content " style="width:90%;margin:0px auto;padding-top:50px;">
            <?php
                if($_SESSION['clearance'] == "2s" OR $_SESSION['clearance'] > 2){
                    if($_REQUEST['file'] == "notes"){
                        echo '<div class="tableagenda" style="overflow: auto;background: white;border-radius: 10px;-webkit-box-shadow: 3px 1px 10px 0px rgba(50, 50, 50, 0.6);-moz-box-shadow:    3px 1px 10px 0px rgba(50, 50, 50, 0.6);box-shadow:         3px 3px 10px 0px rgba(50, 50, 50, 0.6);margin-bottom:30px;">
            <table class="table table-striped" id="tablefinance">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Note</th>
                    <th scope="col">Submitted By</th>
                    <th scope="col">Submitted On</th>
                    <th scope="col">Save</th>
                </tr>
                </thead>
                <tbody>
                ';
                $sql = "SELECT * FROM notes WHERE club = ? ORDER BY noteID DESC;";
                $stmt = mysqli_stmt_init($link);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    echo "SQL Statement Failed";
                }else{
                    mysqli_stmt_bind_param($stmt, "s", $_SESSION["currentclub"]);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    while($row = mysqli_fetch_array($result)){
                        echo '
                               <tr>
                               <form action="./includes/updatenotes.php?id='.htmlspecialchars($row['noteID']).'" method="post">
                                    <th scope="row">'.htmlspecialchars($row["noteID"]).'</th>
                                    <td><textarea name="note" type="text" style="width:100%;height:100%;" rows="8" cols="50">'.htmlspecialchars($row["note"]).'</textarea></td>
                                    <td>'.htmlspecialchars($row["submittedby"]).'</td>
                                    <td>'.htmlspecialchars($row["datetimeval"]).'</td>
                                    <td style="height:200px !important; display:flex; align-items:center;"><input type="submit" class="editbtn" style="" value="Save"></td>
                                    </form>
                                </tr>
                            ';

                    }
                }
                
echo '
                </tbody>
            </table>
            </div>';
                    }
                }
                if($_SESSION['clearance'] == "2T" OR $_SESSION['clearance'] > 2) {
                    if ($_REQUEST['file'] == "finances") {
                        echo '<div class="tableagenda" style="overflow: auto;background: white;border-radius: 10px;-webkit-box-shadow: 3px 1px 10px 0px rgba(50, 50, 50, 0.6);-moz-box-shadow:    3px 1px 10px 0px rgba(50, 50, 50, 0.6);box-shadow:         3px 3px 10px 0px rgba(50, 50, 50, 0.6);margin-bottom:30px;">
            <table class="table table-striped" id="tablefinance">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Reason</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Type</th>
                    <th scope="col">Submitted By</th>
                    <th scope="col">Submitted On</th>
                    <th scope="col">Save</th>
                </tr>
                </thead>
                <tbody>
                ';
                        $sql = "SELECT * FROM finance WHERE club = ? ORDER BY transactionID DESC;";
                        $stmt = mysqli_stmt_init($link);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            echo "SQL Statement Failed";
                        }else{
                            mysqli_stmt_bind_param($stmt, "s", $_SESSION["currentclub"]);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);

                            while($row = mysqli_fetch_array($result)){
                                echo '
                               <tr>
                               <form action="./includes/updatefinances.php?id='.htmlspecialchars($row['transactionID']).'" method="post">
                                    <th scope="row">'.htmlspecialchars($row["transactionID"]).'</th>
                                    <td><textarea name="note" type="text" style="width:100%;height:100%;" rows="8" cols="20">'.htmlspecialchars($row["reason"]).'</textarea></td>
                                    <td><input type="number" name="amount" value="'.$row['amount'].'"></td>
                                    <td><input type="text" name="transtype" value="'.$row['transtype'].'"></td>
                                    <td>'.htmlspecialchars($row["submittedby"]).'</td>
                                    <td>'.htmlspecialchars($row["datetimeval"]).'</td>
                                    <td style="height:200px !important; display:flex; align-items:center;"><input type="submit" class="editbtn" style="" value="Save"></td>
                                    </form>
                                </tr>
                            ';

                            }
                        }

                        echo '
                </tbody>
            </table>
            </div>';
                    }
                }
            if($_SESSION['clearance'] > 2) {
                if ($_REQUEST['file'] == "announcement") {
                    echo '<div class="tableagenda" style="overflow: auto;background: white;border-radius: 10px;-webkit-box-shadow: 3px 1px 10px 0px rgba(50, 50, 50, 0.6);-moz-box-shadow:    3px 1px 10px 0px rgba(50, 50, 50, 0.6);box-shadow:         3px 3px 10px 0px rgba(50, 50, 50, 0.6);margin-bottom:30px;">
            <table class="table table-striped" id="tablefinance">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Note</th>
                    <th scope="col">Submitted By</th>
                    <th scope="col">Submitted On</th>
                    <th scope="col">Save</th>
                </tr>
                </thead>
                <tbody>
                ';
                    $sql = "SELECT * FROM announcements WHERE club = ? ORDER BY announcementid DESC;";
                    $stmt = mysqli_stmt_init($link);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo "SQL Statement Failed";
                    }else{
                        mysqli_stmt_bind_param($stmt, "s", $_SESSION["currentclub"]);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        while($row = mysqli_fetch_array($result)){
                            echo '
                               <tr>
                               <form action="./includes/updateannouncements.php?id='.htmlspecialchars($row['announcementID']).'" method="post">
                                    <th scope="row">'.htmlspecialchars($row["announcementID"]).'</th>
                                    <td><textarea name="note" type="text" style="width:100%;height:100%;" rows="8" cols="50">'.htmlspecialchars($row["announcement"]).'</textarea></td>
                                    <td>'.htmlspecialchars($row["submittedby"]).'</td>
                                    <td>'.htmlspecialchars($row["datetimeval"]).'</td>
                                    <td style="height:200px !important; display:flex; align-items:center;"><input type="submit" class="editbtn" style="" value="Save"></td>
                                    </form>
                                </tr>
                            ';

                        }
                    }

                    echo '
                </tbody>
            </table>
            </div>';
                }
            }
            if($_SESSION['clearance'] > 2){
                if($_REQUEST['file'] == "agendas"){

                    $config = HTMLPurifier_Config::createDefault();
                    $purifier = new HTMLPurifier($config);
            $sql = "SELECT * FROM agenda WHERE club = ? ORDER BY entryID DESC;";
            $stmt = mysqli_stmt_init($link);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                echo "SQL Statement Failed";
            }else{
                mysqli_stmt_bind_param($stmt, "s", $_SESSION["currentclub"]);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $counter = 0;
                while($row = mysqli_fetch_array($result)) {
                    $clean_html = $purifier->purify($row['message']);
                    echo '<div style="text-align:center">
                        <div class="editor" id="editor'.$row['entryID'].'" STYLE="padding-top:5px;height:300px;padding-right:10px;-webkit-box-shadow: 3px 1px 10px 0px rgba(50, 50, 50, 0.6);-moz-box-shadow:    3px 1px 10px 0px rgba(50, 50, 50, 0.6);box-shadow:         3px 3px 10px 0px rgba(50, 50, 50, 0.6);margin:0px auto;" data-entrynumber="'.$row['entryID'].'">
'.$clean_html.'
                <div id="toolbar"></div>
            </div>           
              <input type="submit" id="agendasender" onclick="sendagenda('.$counter.')" value="Update" style="width:150px;height:40px;background:#2b2f49;color:white;border:none;border-radius:5px;margin-top:30px;">
    
                    ';
                    echo "<script>
    var quill = new Quill('#editor".$row["entryID"]."', {
        theme: 'snow'
    });
</script></div><div class='divider'></div>";
                    $counter = $counter + 1;
                }
                }
                }
            }
            ?>
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
<script>
    function sendagenda(number){
        var yes = document.getElementsByClassName("ql-editor")[number];
        //var elmnt = yes.contentWindow.document.getElementsByTagName("body")[0];
        //var elmntinner = elmnt.innerHTML;
        var yesinner = yes.innerHTML;
        var agendadiv = document.getElementsByClassName("editor")[number];
        var agendaNumber = agendadiv.dataset.entrynumber;
        //var bodymessage = document.getElementsByClassName("mce-content-body")[0];
        //console.log(elmnt);
        $.post( "./includes/updateagendas.php", { agendamessage: yesinner, entryid: agendaNumber })
            .done(function( data ) {

            });
        //window.location.href = "./includes/agendainc.php";
        //location.reload();
    }
</script>
<?php require_once"footer.php" ?>
</body>
</html>
