<?php
?>

<div class="upper-main d-flex" style="justify-content:space-between;align-items:center;">
    <div class="taskbar-button">
        <input type="checkbox" id="checkfml" onchange="calc()">
        <label for="checkfml" class="checkbtn">
            <i class="fas fa-bars" style="font-size:50px;margin-left:30px;"></i>
        </label>

    </div>

    <div class="info d-flex" style="padding-right:40px;">
        <div class="left-info" style="font-family: 'Enriqueta', serif;margin-right:30px;">
            <p>Welcome</p>
            <p><?php echo $_SESSION['username']; ?></p>
        </div>
        <div class="right-info">
            <img src="<?php echo $_SESSION['pfp'];?>" alt="" style="width:50px;height:50px;border-radius:50%;">
        </div>
    </div>
</div>
