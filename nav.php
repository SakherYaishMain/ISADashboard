<?php
if (!isset($_SESSION['username'])) {
    //$_SESSION['msg'] = "You must log in first";
    header('location: index.php');


}
$currentpage = $_SESSION['currentpage'];
?>

<div class="left-side-taskbar">
    <div class="title-left-taskbar d-flex align-items-center" style="padding-top:20px;color:white;padding-left:10px;" data-page="<?php echo $currentpage;?>">
        <i class="fas fa-leaf" style="color:White;font-size:45px;padding-right:15px;"></i>
        <h4 style="margin:0px;"><strong>Black</strong>Rose</h4>
    </div>
    <p style="color:grey;margin-left:30px;margin-top:50px;">MAIN</p>

    <ul class="taskbar" id="linkparent">
        <a href="home.php"><li class="dashlink" data-currentpage="dashboard"><i class="fas fa-columns" style="margin-right:20px;"></i>Dashboard</li></a>
        <?php
            if($_SESSION['clearance'] > 2 OR $_SESSION['clearance'] === "2S" OR $_SESSION['clearance'] === "2T" OR $_SESSION['clearance'] === "2SM"){
                echo '<a href="announcements.php"><li class="dashlink" data-currentpage="announcements"><i class="fas fa-bullhorn" style="margin-right:20px;"></i>Announcements</li></a>';
            }
        ?>
        <?php
        if($_SESSION['clearance'] > 2 OR $_SESSION['clearance'] === "2S"){
            echo '<a href="notes.php"><li class="dashlink" data-currentpage="notes"><i class="far fa-clipboard" style="margin-right:20px;"></i>Meeting Notes</li></a>';
        }
        ?>
        <?php
            if($_SESSION['clearance'] > 1 or $_SESSION['clearance'] === "2S" or $_SESSION['clearance'] === "2T") {
                echo '<a href="finance.php"><li class="dashlink" data-currentpage="finance"><i class="fas fa-landmark" style="margin-right:20px;"></i>Finances</li></a>';
            }
        ?>

        <a href="todolist.php"><li class="dashlink" data-currentpage="todo"><i class="fas fa-list-ul" style="margin-right:20px;"></i>To do list</li></a>
        <a href="agenda.php"><li class="dashlink" data-currentpage="agenda"><i class="far fa-calendar-check" style="margin-right:20px;"></i>Agenda</li></a>
        <?php
        if($_SESSION['clearance'] > 2) {
            echo '<a href="executive.php"><li class="dashlink" data-currentpage="executive"><i class="far fa-star" style="margin-right:14px;"></i>Executive Branch</li></a>';
        }
        ?>

        <a href="files.php"><li class="dashlink" data-currentpage="files"><i class="far fa-file-archive" style="margin-right:20px;"></i>Files</li></a>
        <a href="events.php"><li class="dashlink" data-currentpage="events"><i class="far fa-calendar-plus" style="margin-right:20px;"></i>Events</li></a>
    </ul>


    <p style="color:grey;margin-left:30px;margin-top:100px;">HELP</p>
    <ul class="taskbar taskbar2" id="linkparent2">
        <a href="settings.php"><li class="dashlink" data-currentpage="settings"><i class="fas fa-cogs" style="margin-right:20px;"></i>Settings</li></a>
        <a href=""><li class="dashlink" data-currentpage="support"><i class="far fa-question-circle" style="margin-right:20px;"></i>Support</li></a>
        <a href="index.php?logout='1'"><li class="dashlink"><i class="fas fa-sign-out-alt" style="margin-right:20px;margin-bottom:30px;"></i>Log out</li></a>
        <a href=""><li style=""></li></a>
    </ul>



</div>

<script type="text/javascript">
    // Get the container element
    var btnContainer = document.getElementById("linkparent");

    // Get all buttons with class="btn" inside the container
    var btns = btnContainer.getElementsByClassName("dashlink");
    var currentpage = document.getElementsByClassName("title-left-taskbar")[0].dataset.page;
    // Loop through the buttons and add the active class to the current/clicked button
    for (var i = 0; i < btns.length; i++) {
        if(btns[i].dataset.currentpage == currentpage){
            btns[i].classList.add("active");
        }

    }
    var btnContainer2 = document.getElementById("linkparent2");

    // Get all buttons with class="btn" inside the container
    var btns2 = btnContainer2.getElementsByClassName("dashlink");
    var currentpage = document.getElementsByClassName("title-left-taskbar")[0].dataset.page;
    // Loop through the buttons and add the active class to the current/clicked button
    for (var i = 0; i < btns2.length; i++) {
        if(btns2[i].dataset.currentpage == currentpage){
            btns2[i].classList.add("active");
        }

    }
</script>