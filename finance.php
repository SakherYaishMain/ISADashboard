<?php
session_set_cookie_params('o', '/', 'localhost/ISAdashboard', isset($_SERVER["HTTPS"]), true);
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2/dist/Chart.min.js"></script>
    <script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>

</head>
<body style="background:#fafcfe;">
<div class="content d-flex">
    <?php require"nav.php";?>
    <div class="main-content">
        <?php require"uppernav.php";?>
        <h2 style="width:90%;margin:0px auto;font-weight:600;margin-top:150px;font-size:20px;">FINANCE</h2>
        <div class="center-content d-flex flex-wrap d-flex" style="width:90%;margin:0px auto;padding-top:50px;">
            <div class="insert-finance money-left d-flex justify-content-center flex-wrap" style="width:500px;height:350px;background:;">
                <div class="financetitle align-items-center justify-content-flexstart" style="width:100%;">
                    <h3 style="margin-left:10px;margin-top:10px;">Add to budget</h3>
                    <i class="fas fa-chart-line" style="font-size:90px;width:100%;text-align: center;"></i>
                </div>
                <div class="financeinsert d-flex justify-content-center" style="width:100%;">
                    <div style="width: 100%;text-align:center;">

                        <form class="" action="./includes/financeaddinc.php" method="post">
                            <i class="fas fa-dollar-sign" style="position: absolute;font-size:30px;line-height:40px;margin-left:5px;"></i>
                            <input type="number" name="amount" style="width:90%;height:40px;border-radius:5px;background:white;border:1px solid grey;padding:0px 35px;font-size:20px;font-weight: bold;" id="dataholderinput" required <?php
                            $sql = "SELECT sum(amount) FROM finance WHERE transtype='Addition'";
                            $stmt = mysqli_stmt_init($link);
                            if(!mysqli_stmt_prepare($stmt, $sql)){
                                echo "SQL Statement Failed";
                            }else{
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                while($row = mysqli_fetch_array($result)){
                                    $totalmoney = $row['sum(amount)'];
                                }
                            }
                            $sql2 = "SELECT sum(amount) FROM finance WHERE transtype='Expense'";
                            $stmt2 = mysqli_stmt_init($link);
                            if(!mysqli_stmt_prepare($stmt2, $sql2)){
                                echo "SQL Statement Error";
                            }
                            else{
                                mysqli_stmt_execute($stmt2);
                                $result2 = mysqli_stmt_get_result($stmt2);
                                while($row2 = mysqli_fetch_array($result2)){
                                    $totalexpense = $row2['sum(amount)'];
                                }
                            }
                            //echo $totalexpense."ass";
                            //echo $totalmoney;
                            $profit = $totalmoney - $totalexpense;
                            echo "data-money-total='".$profit."' ";
                            echo "data-money-left='".$totalexpense."'";
                            echo "/>";
                            ?>
                            <input type="text" placeholder="Reason" name="reason" style="margin-top:20px;width:90%;height:40px;border-radius:5px;background:white;border:1px solid grey;padding:0px 15px;font-size:20px;font-weight: bold;" required/>
                            <input type="submit" value="Submit" style="background: #2b2f49;border:none;color:White;margin-top:20px;width:150px;height:35px;border-radius:5px;"/>
                        </form>

                    </div>

                </div>

            </div>
            <div class="insert-finance money-left d-flex justify-content-center flex-wrap expenses" style="width:500px;height:350px;background:;margin-left:60px;">
                <div class="financetitle align-items-center justify-content-flexstart" style="width:100%;">
                    <h3 style="margin-left:10px;margin-top:10px;">Expenses</h3>
                    <i class="fas fa-chart-line" style="font-size:90px;width:100%;text-align: center;color:darkred;"></i>
                </div>
                <div class="financeinsert d-flex justify-content-center" style="width:100%;">
                    <div style="width: 100%;text-align:center;">

                        <form class="" action="./includes/financeremoveinc.php" method="post">
                            <i class="fas fa-dollar-sign" style="position: absolute;font-size:30px;line-height:40px;margin-left:5px;"></i>
                            <input type="number" name="amount" style="width:90%;height:40px;border-radius:5px;background:white;border:1px solid grey;padding:0px 35px;font-size:20px;font-weight: bold;" required/>
                            <input type="text" placeholder="Reason" name="reason" style="margin-top:20px;width:90%;height:40px;border-radius:5px;background:white;border:1px solid grey;padding:0px 15px;font-size:20px;font-weight: bold;" required/>
                            <input type="submit" value="Submit" style="background: #2b2f49;border:none;color:White;margin-top:20px;width:150px;height:35px;border-radius:5px;"/>
                        </form>

                    </div>

                </div>

            </div>
            <div class="money-left financeinfo" style="width:300px;height:350px;margin-left:60px;">
                <p style="margin-top:60px;"><strong>Started Semester With: </strong>$3521</p>
                <div style="width:90%;height:2px;background: #000000;margin:0px auto;"></div>
                <p><strong>Total Current Budget: </strong><?php
                    echo $profit;



                    ?></p>
                <div style="width:90%;height:2px;background: black;margin:0px auto;"></div>
                <p><strong>Total Expenses: </strong><?php
                    $sql = "SELECT sum(amount) FROM finance WHERE transtype = 'Expense'";
                    $stmt = mysqli_stmt_init($link);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo "SQL Error";
                    }else{
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        while($row = mysqli_fetch_array($result)){
                            echo "$".$row['sum(amount)'];
                        }
                    }
                    ?></p>
            </div>
            <div class="money-left graph" style="width:500px;height:500px;margin-top:60px;">
                <canvas id="myChart" width="400" height="400"></canvas>
            </div>
            <div class="money-left transactiontable" style="width: 860px; margin-left:60px;height:500px;margin-top:60px;overflow:auto;margin-bottom:30px;">
                <label for="excel"><i class="fas fa-file-excel" style="font-size:40px;margin-left:10px;margin-top:10px;margin-bottom:10px;cursor: pointer;"></i></label>
                <input type="checkbox" name="excel" id="excel" onclick="downloadexcel()" style="display: none;"/><br>

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
                    $sql = "SELECT * FROM finance ORDER BY transactionID ASC;";
                    $stmt = mysqli_stmt_init($link);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo "SQL Statement Failed";
                    }else{
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        while($row = mysqli_fetch_array($result)){
                            echo "
                               <tr>
                                    <th scope='row'>".htmlspecialchars($row['transactionID'])."</th>
                                    <td>".$row['transtype']."</td>
                                    <td>".$row['amount']."</td>
                                    <td>".$row['reason']."</td>
                                    <td>".$row['submittedby']."</td>
                                    <td>".$row['datetimeval']."</td>
                                </tr>
                            ";

                        }
                    }
                    ?>

                    </tbody>
                </table>
            </div>

            <script>
                var datainput = document.querySelector("#dataholderinput");
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Money Left', 'Money Spent'],
                        datasets: [{
                            label: '# of Votes',
                            data: [datainput.dataset.moneyTotal,datainput.dataset.moneyLeft],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)'

                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)'

                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            </script>

        </div>
    </div>
</div>
<script type="text/javascript">
    function downloadexcel(){
        $("#tablefinance").table2excel({
            filename: "isafinance.xls"
        });
    };
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

</body>
</html>
