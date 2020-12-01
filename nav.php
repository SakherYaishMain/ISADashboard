<?php
if (!isset($_SESSION['username'])) {
    //$_SESSION['msg'] = "You must log in first";
    header('location: index.php');
}
?>

<div class="left-side-taskbar">
    <div class="title-left-taskbar d-flex align-items-center" style="padding-top:20px;color:white;padding-left:10px;">
        <i class="fab fa-fedora" style="color:White;font-size:45px;padding-right:15px;"></i>
        <h4 style="margin:0px;"><strong>ISA</strong>TEAM</h4>
    </div>
    <p style="color:grey;margin-left:30px;margin-top:50px;">MAIN</p>

    <ul class="taskbar">
        <a href="home.php"><li><i class="fas fa-columns" style="margin-right:20px;"></i>Dashboard</li></a>
        <?php
            if($_SESSION['clearance'] > 2 OR $_SESSION['clearance'] == "2S" OR $_SESSION['clearance'] == "2T" OR $_SESSION['clearance'] == "2SM"){
                echo '<a href="announcements.php"><li><i class="fas fa-bullhorn" style="margin-right:20px;"></i>Announcements</li></a>';
            }
        ?>
        <?php
        if($_SESSION['clearance'] > 2 OR $_SESSION['clearance'] == "2S"){
            echo '<a href="notes.php"><li><i class="far fa-clipboard" style="margin-right:20px;"></i>Meeting Notes</li></a>';
        }
        ?>
        <?php
            if($_SESSION['clearance'] > 1) {
                echo '<a href="finance.php"><li><i class="fas fa-landmark" style="margin-right:20px;"></i>Finances</li></a>';
            }
        ?>

        <a href=""><li><i class="fas fa-list-ul" style="margin-right:20px;"></i>To do list</li></a>
        <a href="agenda.php"><li><i class="far fa-calendar-check" style="margin-right:20px;"></i>Agenda</li></a>
    </ul>


    <p style="color:grey;margin-left:30px;margin-top:100px;">HELP</p>
    <ul class="taskbar taskbar2">
        <a href="settings.php"><li><i class="fas fa-cogs" style="margin-right:20px;"></i>Settings</li></a>
        <a href=""><li><i class="far fa-question-circle" style="margin-right:20px;"></i>Support</li></a>
        <a href="index.php?logout='1'"><li><i class="fas fa-sign-out-alt" style="margin-right:20px;margin-bottom:30px;"></i>Log out</li></a>
        <a href=""><li></li></a>
    </ul>



</div>
