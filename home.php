<?php
 
session_start();
require_once"./connections/connect.php";
$_SESSION['currentpage'] = "dashboard";
date_default_timezone_set("Asia/Riyadh");
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
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>-->

</head>
<body style="background:#fafcfe;">
<div class="content d-flex">
    <?php require"nav.php";?>
    <div class="main-content">
        <?php require"uppernav.php";?>
        <h2 style="width:90%;margin:0px auto;font-weight:600;margin-top:150px;font-size:20px;"><?php echo $_SESSION['currentclub'];?></h2>
        <h2 style="width:90%;margin:0px auto;font-weight:600;margin-top:20px;font-size:20px;">OVERVIEW</h2>
        <div class="center-content d-flex flex-wrap" style="width:90%;margin:0px auto;padding-top:50px;">


            <div class="money-left d-flex align-items-center">
                <div class="money-left-left">
                    <i class="fas fa-dollar-sign" style="color:#085646; font-size:60px;border:5px solid black;padding:10px 20px;border-radius:50%;border-color:#085646;margin-left:20px;"></i>
                </div>
                <div class="money-left-right">
                    <p class='moneyamount' style="font-size:35px;margin:0px;margin-left:20px;"><strong>
                            <?php
                            $sql = "SELECT sum(amount) FROM finance WHERE transtype='Addition' AND club = ?";
                            $stmt = mysqli_stmt_init($link);
                            if(!mysqli_stmt_prepare($stmt, $sql)){
                                echo "SQL Statement Failed";
                            }else{
                                mysqli_stmt_bind_param($stmt, "s", $_SESSION['currentclub']);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                while($row = mysqli_fetch_array($result)){
                                    $totalmoney = $row['sum(amount)'];
                                }
                            }
                            $sql2 = "SELECT sum(amount) FROM finance WHERE transtype='Expense' AND club = ?";
                            $stmt2 = mysqli_stmt_init($link);
                            if(!mysqli_stmt_prepare($stmt2, $sql2)){
                                echo "SQL Statement Error";
                            }
                            else{
                                mysqli_stmt_bind_param($stmt2, "s", $_SESSION['currentclub']);
                                mysqli_stmt_execute($stmt2);
                                $result2 = mysqli_stmt_get_result($stmt2);
                                while($row2 = mysqli_fetch_array($result2)){
                                    $totalexpense = $row2['sum(amount)'];
                                }
                            }
                            //echo $totalexpense."ass";
                            //echo $totalmoney;
                            $profit = $totalmoney - $totalexpense;
                            echo $profit;
                            ?>
                        </strong> USD</p>
                    <p class='submoney' style="font-size:15px;margin:0px;margin-left:20px;"><strong>Total Budget</strong></p>
                </div>
            </div>



            <div class="money-left d-flex align-items-center money-right" style="margin-left:80px;">
                <div class="money-left-left">
                    <i class="fas fa-chart-line" style="color:#8b0000; font-size:60px;border:5px solid black;padding:10px 20px;border-radius:50%;border-color:#8b0000;margin-left:20px;"></i>
                </div>
                <div class="money-left-right">
                    <p class='moneyamount' style="font-size:35px;margin:0px;margin-left:20px;"><strong>
                            <?php
                            if($totalexpense != ""){
                                echo $totalexpense;
                            }else{
                                echo "0";
                            }
                            ?></strong> USD</p>
                    <p class='submoney' style="font-size:15px;margin:0px;margin-left:20px;"><strong>Total Money Left</strong></p>
                </div>

            </div>


            <div class="notes-overview">
                <h2 style="font-weight:600;margin-left:30px;margin-top:20px;border-bottom:3px solid black;padding-bottom:10px;width:325px;">Latest meeting notes</h2>
                <p style="margin:30px;"><?php

                    $sql = "SELECT * FROM notes WHERE club = ? ORDER BY noteID DESC LIMIT 1;";
                    $stmt = mysqli_stmt_init($link);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo "SQL Statement Failed";
                    }else{
                        mysqli_stmt_bind_param($stmt, "s", $_SESSION['currentclub']);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        while($row = mysqli_fetch_array($result)){
                            echo htmlspecialchars($row['note']);
                            echo "</p>";
                            echo '<h6 style="margin:30px;font-weight:600;">Added by Secretay '.htmlspecialchars($row['submittedby']).'  on '.$row['datetimeval']. '</h6>';
                        }
                    }
                    ?></p>

            </div>
            <div id='calendar' style="margin-bottom:50px;">
            </div>
            <div class="announcements-overview">
                <h2 style="font-weight:600;margin-left:30px;margin-top:20px;border-bottom:3px solid black;padding-bottom:10px;width:360px;">Latest announcements</h2>
                <p style="margin:30px;"><?php
                    $sql = "SELECT * FROM announcements WHERE club = ? ORDER BY announcementID DESC LIMIT 1;";

                    $stmt = mysqli_stmt_init($link);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo "SQL Statement Failed";
                    }else{
                        mysqli_stmt_bind_param($stmt, "s", $_SESSION['currentclub']);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        while($row = mysqli_fetch_array($result)){
                            echo htmlspecialchars($row['announcement']);
                            echo "</p>";
                            echo '<h6 style="margin:30px;font-weight:600;">Added by Secretay '.htmlspecialchars($row['submittedby']).'  on '.$row['datetimeval']. '</h6>';
                        }
                    }
                    ?>
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

<script>

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            handleWindowResize:true,
            windowResize:true,
            height:700,
            headerToolbar: {
                left: 'prevYear,prev,next,nextYear today',
                center: 'title',
                right: 'dayGridMonth,dayGridWeek,dayGridDay'
            },
            navLinks: true, // can click day/week names to navigate views
            editable: false,
            dayMaxEvents: true, // allow "more" link when too many events
            events: [
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
                            echo "{
                                title:'".$row['eventName']."',
                                start:'".$row['dateStart']."',
                                end:'".$row['dateEnd']."'
                            },";
                        }    
                    }
                ?>
                
            ]
        });

        calendar.render();
    });

</script>
<?php require_once"footer.php" ?>
</body>
</html>
