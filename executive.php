<?php
session_set_cookie_params('o', '/', 'https://isadashboard.000webhostapp.com/', isset($_SERVER["HTTPS"]), true);
require_once "./connections/connect.php";
session_start();
$_SESSION['currentpage'] = "executive";
?>

<?php
if($_SESSION['clearance']<3){
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2/dist/Chart.min.js"></script>
    <script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>

</head>
<body style="background:#fafcfe;">
<div class="content d-flex">
    <?php require"nav.php";?>
    <div class="main-content">
        <?php require"uppernav.php";?>
        <h2 style="width:90%;margin:0px auto;font-weight:600;margin-top:150px;font-size:20px;"><?php echo $_SESSION['currentclub'];?></h2>
        <h2 style="width:90%;margin:0px auto;font-weight:600;margin-top:20px;font-size:20px;">Executive Branch</h2>
        <div class="center-content d-flex flex-wrap d-flex" style="width:90%;margin:0px auto;padding-top:30px;">

            <div class="insert-finance money-left d-flex justify-content-center flex-wrap" style="width:500px;height:500px;background:;">
                <div class="financetitle align-items-center justify-content-flexstart" style="width:100%;">
                    <h3 style="margin-left:10px;margin-top:10px;">Club Invitations</h3>
                    <i class="fas fa-user-plus" style="font-size:90px;width:100%;text-align: center;"></i>
                </div>
                <div class="financeinsert d-flex justify-content-center" style="width:100%;">
                    <div style="width: 100%;text-align:center;">

                        <form class="" action="./includes/adduser.php" method="post">
                            <i class="fas fa-at" style="<?php if($_SESSION['clearance'] < 2 OR $_SESSION['clearance'] == "2S" OR $_SESSION['clearance'] == "2SM"){ echo 'display:none;';}?>position: absolute;font-size:30px;line-height:40px;margin-left:5px;"></i>

                            <input type="text" name="email" style="<?php if($_SESSION['clearance'] < 2 OR $_SESSION['clearance'] == "2S" OR $_SESSION['clearance'] == "2SM"){ echo 'display:none;';}?>width:90%;height:40px;border-radius:5px;background:white;border:1px solid grey;padding:0px 45px;font-size:20px;font-weight: bold;" placeholder="Email" required>


                            <select name="position" placeholder="yes" id="cars" style="margin-top:20px;width:90%;height:40px;border-radius:5px;background:white;border:1px solid grey;padding:0px 15px;font-size:20px;font-weight: bold;">
                                <option value="member">Member</option>
                                <option value="secretary">Secretary</option>
                                <option value="media">Social Media Officer</option>
                                <option value="Treasurery">Treasurery</option>
                                <option value="vice">Vice President</option>
                                <option value="president">President</option>
                                <option value="president">Advisor</option>
                            </select>
                            <input type="text" placeholder="Name" name="name" style="margin-top:20px;width:90%;height:40px;border-radius:5px;background:white;border:1px solid grey;padding:0px 15px;font-size:20px;font-weight: bold;" required/>
                            <input type="submit" value="Submit" style="background: #2b2f49;border:none;color:White;margin-top:125px;width:150px;height:35px;border-radius:5px;"/>




                        </form>

                    </div>

                </div>

            </div>
            <div class="insert-finance money-left d-flex justify-content-center flex-wrap expenses" style="width:500px;height:500px;background:;margin-left:60px;">
                <div class="financetitle align-items-center justify-content-flexstart" style="width:100%;">
                    <h3 style="margin-left:10px;margin-top:10px;">Club Terminations</h3>
                    <i class="fas fa-user-minus" style="font-size:90px;width:100%;text-align: center;color:darkred;"></i>
                </div>
                <div class="financeinsert d-flex justify-content-center" style="width:100%;">
                    <div style="width: 100%;text-align:center;">

                            <form class="" action="./includes/deleteuser.php" method="post">
                            <i class="fas fa-at" style="position: absolute;font-size:30px;line-height:40px;margin-left:5px;"></i>
                            <input type="text" name="email" style="width:90%;height:40px;border-radius:5px;background:white;border:1px solid grey;padding:0px 45px;font-size:20px;font-weight: bold;" placeholder="Email" required/>
                                <select placeholder="yes" name="name" style="margin-top:20px;width:90%;height:40px;border-radius:5px;background:white;border:1px solid grey;padding:0px 15px;font-size:20px;font-weight: bold;">
                                    <?php
                                    //SELECT * FROM users INNER JOIN clearance ON users.userID = clearance.userID WHERE users.clubs LIKE "%ISA%" AND clearance.club ="ISA"
                                    $yesclub2 = "%".$_SESSION['currentclub']."%";
                                    $sql = "SELECT * FROM users INNER JOIN clearance ON users.userID = clearance.userID WHERE users.clubs LIKE ? AND clearance.club = ? ORDER BY clearance.level DESC;";
                                    $stmt = mysqli_stmt_init($link);
                                    if(!mysqli_stmt_prepare($stmt, $sql)){
                                        echo "SQL Statement Failed";
                                    }else{
                                        mysqli_stmt_bind_param($stmt, "ss", $yesclub2, $_SESSION['currentclub']);
                                        mysqli_stmt_execute($stmt);
                                        $result = mysqli_stmt_get_result($stmt);

                                        while($row = mysqli_fetch_array($result)){
                                            echo '<option value="'.$row['username'].'">'.$row['username'].'</option>';

                                        }
                                    }
                                    ?>
                                </select>
                            <textarea name="reason" id="" cols="30" rows="5" placeholder="Reason" style="width:90%;margin-top:20px;padding:10px;border-radius: 5px;"></textarea>
                            <input type="submit" value="Submit" style="background: #2b2f49;border:none;color:White;margin-top:20px;width:150px;height:35px;border-radius:5px;"/>
                        </form>


                    </div>

                </div>

            </div>
            <div class="money-left financeinfo" style="width:300px;height:500px;margin-left:60px;">
                <i class="fas fa-users" style="font-size:80px;width:100%;text-align:center;margin-top:144px;margin-bottom:10px;"></i>
                <h3 style="text-align: center">Total Members</h3>
                <?php
                $yesclub = "%".$_SESSION['currentclub']."%";
                $sql = "SELECT count(username) FROM users INNER JOIN clearance ON users.userID = clearance.userID WHERE users.clubs LIKE ? AND clearance.club = ? ORDER BY clearance.level DESC;";
                $stmt = mysqli_stmt_init($link);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                echo "SQL Statement Failed";
                }else{
                mysqli_stmt_bind_param($stmt, "ss", $yesclub, $_SESSION['currentclub']);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                while($row = mysqli_fetch_array($result)){
                echo '<h1 style="text-align: center">'.$row['count(username)'].'</h1>';

                }
                }
                ?>
            </div>

            <div class="money-left transactiontable" style="width: 1420px;height:500px;margin-top:60px;overflow:auto;margin-bottom:30px;">
                <table class="table table-striped" id="tablefinance">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Added By</th>
                        <th scope="col">Clearance</th>
                        <th scope="col">Position</th>
                        <th scope="col">Edit/Save</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    //SELECT * FROM users INNER JOIN clearance ON users.userID = clearance.userID WHERE users.clubs LIKE "%ISA%" AND clearance.club ="ISA"
                    $yesclub2 = "%".$_SESSION['currentclub']."%";
                    $sql = "SELECT * FROM users INNER JOIN clearance ON users.userID = clearance.userID WHERE users.clubs LIKE ? AND clearance.club = ? ORDER BY clearance.level DESC;";
                    $stmt = mysqli_stmt_init($link);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo "SQL Statement Failed";
                    }else{
                        mysqli_stmt_bind_param($stmt, "ss", $yesclub2, $_SESSION['currentclub']);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $index = 0;
                        while($row = mysqli_fetch_array($result)){

                            echo "<form method='post' action='./includes/updatemember.php?id=".$row['userID']."' id='thisform'>
                               <tr>
                                    <th scope='row'>".htmlspecialchars($row['userID'])."</th>
                                    <td>".htmlspecialchars($row['username'])."</td>
                                    <td>".htmlspecialchars($row['email'])."</td>
                                    <td>".htmlspecialchars($row['addedby'])."</td>
                                    ";
                                    if($row['level'] <= $_SESSION['clearance']){
                                        echo "<td><input type='number'  name='level' min='1' max='5' style='width:60px;background:none;border:none;' class='editmember' disabled value='".htmlspecialchars($row['level'])."'</td>";
                                    }else{
                                        echo "<td>".htmlspecialchars($row['level'])."</td>";
                                    }
                            echo"
                                    
                                    <td>".htmlspecialchars($row['position'])."</td>";
                                if($row['level'] <= $_SESSION['clearance']){
                                    echo "<td><input type='button' value='Edit' name='level' style='height:35px;width:80px;padding:5px;' onclick='editmember(".$index.")' class='editbtn savemember'></form></td>";
                                }else{
                                    echo "<td><input disabled type='button' value='Edit' style='background:grey;height:35px;width:80px;padding:5px;' class='editbtn savemember'/> </td>";
                                }

                                echo "</tr>";
                                }
                                $index = $index + 1;
}







                    ?>

                    </tbody>
                </table>
            </div>



        </div>
    </div>
</div>

<script type="text/javascript">
    function editmember(number){
        var inputwanted = document.getElementsByClassName("editmember")[number];
        inputwanted.removeAttribute("disabled");
        var btn = document.getElementsByClassName("savemember")[number];
        inputwanted.classList.add("editinput");
        if(btn.value == "Edit"){
            btn.value = "Save";
        }else{
            btn.value = "Edit";
            inputwanted.classList.remove("editinput");
            document.getElementById("thisform").submit();
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
