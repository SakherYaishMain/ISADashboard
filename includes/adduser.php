<?php
session_set_cookie_params('o', '/', 'localhost/ISAdashboard', isset($_SERVER["HTTPS"]), true);
session_start();
require_once'../connections/connect.php';

date_default_timezone_set("America/Chicago");

$date = date("Y/m/d");
$time = date("h:i:sa");

$datetime = $date . ' ' . $time;

function password_generate($chars)
{
    $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
    return substr(str_shuffle($data), 0, $chars);
}

$name =  $_SESSION['username'];

$email = $_SESSION['email'];

$membername = $_POST['name'];
$position = $_POST['position'];
$memberemail = $_POST['email'];

$pfp = "./images/placeholder.jpg";

$randompswd = password_generate(10);

$hashrandompswd = md5($randompswd);

//$ann = $_POST['note'];


///////////Give clearance level depending on position///////////


if($position == "member"){
    $clearance = 1;
}
elseif ($position == "secretary"){
    $clearance = "2S";
}
elseif ($position == "treasurary") {
    $clearance ="2T";
}
elseif ($position == "media") {
    $clearance ="2SM";
}
elseif ($position == "vice"){
    $clearance = 3;
}
elseif ($position == "president"){
    $clearance = 4;
}
elseif ($position == "advisor"){
    $clearance = 5;
}

$club = $_SESSION['currentclub'].".";




$yesclub2 = "%".$_SESSION['currentclub']."%";
$sql0 = "SELECT * FROM users INNER JOIN clearance ON users.userID = clearance.userID WHERE users.clubs LIKE ? AND clearance.club = ? AND users.email =?";
$stmt0 = mysqli_stmt_init($link);
if(!mysqli_stmt_prepare($stmt0, $sql0)){
    echo "SQL Error";
}else{
mysqli_stmt_bind_param($stmt0, "sss", $yesclub2, $_SESSION['currentclub'], $memberemail);
mysqli_stmt_execute($stmt0);
$result0 = mysqli_stmt_get_result($stmt0);
$row0 = mysqli_fetch_assoc($result0);
if (mysqli_num_rows($result0) == 1) {
    header("location:../executive.php?error=alreadyadded");
    echo "YES HAHA";
    exit;
}

$sqlcheck = "SELECT * FROM users WHERE email = ?";
$stmtcheck = mysqli_stmt_init($link);
if(!mysqli_stmt_prepare($stmtcheck, $sqlcheck)){
        echo "SQL Error";
}else{
        mysqli_stmt_bind_param($stmtcheck, "s", $memberemail);
        mysqli_stmt_execute($stmtcheck);
        $resultcheck = mysqli_stmt_get_result($stmtcheck);
    $rowcheck = mysqli_fetch_assoc($resultcheck);
    if (mysqli_num_rows($resultcheck) == 1) {
        $updatedclub = $rowcheck['clubs'].$_SESSION['currentclub'].".";
        $sqlupdate = "UPDATE users SET clubs = ? WHERE email = ?";
        $stmtupdate = mysqli_stmt_init($link);
        if(!mysqli_stmt_prepare($stmtupdate, $sqlupdate)){
            echo "SQL Error";
        }else{
            mysqli_stmt_bind_param($stmtupdate, "ss", $updatedclub, $memberemail);
            mysqli_stmt_execute($stmtupdate);
        }
        $sql3 = "INSERT INTO clearance (userID, level, club) VALUES (?,?, ?)";
        $stmt3 = mysqli_stmt_init($link);
        if(!mysqli_stmt_prepare($stmt3, $sql3)){
            echo "SQL Error";
        }else{
            mysqli_stmt_bind_param($stmt3, "iis", $rowcheck['userID'], $clearance, $_SESSION['currentclub']);
            mysqli_stmt_execute($stmt3);
        }
    }else{
        $sql = "INSERT INTO users (username, password, addedby, position, pfp, clearance, email, clubs)  VALUES (?, ?, ?, ?, ?, ? , ?, ?);";
        $stmt = mysqli_stmt_init($link);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "SQL Error";
        }else{
            mysqli_stmt_bind_param($stmt, "sssssiss", $membername, $hashrandompswd, $email, $position, $pfp, $clearance, $memberemail, $club);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            //header("location:../home.php");
        }

        $sql2 = "SELECT userID from users WHERE email = ? and username = ?";
        $stmt2 = mysqli_stmt_init($link);
        if(!mysqli_stmt_prepare($stmt2, $sql2)){
            echo "SQL Error";
        }else{
            mysqli_stmt_bind_param($stmt2, "ss", $memberemail, $membername);
            mysqli_stmt_execute($stmt2);
            $result = mysqli_stmt_get_result($stmt2);
            while($row = mysqli_fetch_array($result)){
                $useridinsert = $row['userID'];
            }
        }

        $sql3 = "INSERT INTO clearance (userID, level, club) VALUES (?,?, ?)";
        $stmt3 = mysqli_stmt_init($link);
        if(!mysqli_stmt_prepare($stmt3, $sql3)){
            echo "SQL Error";
        }else{
            mysqli_stmt_bind_param($stmt3, "iis", $useridinsert, $clearance, $_SESSION['currentclub']);
            mysqli_stmt_execute($stmt3);
        }
    }




}

}





////////////////////////SEND EMAIL/////////////////////

//require_once "sendemailinc.php";








//////////////DISCORD WEBHOOK API////////////////
/*$webhookurl = "https://discord.com/api/webhooks/787425123912253461/DRKBYozKX66gAaCDOWyeUGojp28TwOucmjr9UuD3oGy-w8PzBcCo8lnieFB_J5zfDxkt";

//=======================================================================================================
// Compose message. You can use Markdown
// Message Formatting -- https://discordapp.com/developers/docs/reference#message-formatting
//========================================================================================================

$timestamp = date("c", strtotime("now"));
$json_data = json_encode([
    // Message
    "content" => "",

    // Username
    "username" => "Black Rose",

    // Avatar URL.
    // Uncoment to replace image set in webhook
    //"avatar_url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=512",

    // Text-to-speech
    "tts" => false,

    // File upload
    // "file" => "",

    // Embeds Array
    "embeds" => [
        [
            // Embed Title
            "title" => "A new note has been submitted",

            // Embed Type
            "type" => "rich",

            // Embed Description
            "description" => "Check out this new note!",

            // URL of title link
            "url" => "https://isadashboard.000webhostapp.com",

            // Timestamp of embed must be formatted as ISO8601
            "timestamp" => $timestamp,

            // Embed left border color in HEX
            "color" => hexdec( "3366ff" ),

            // Footer


            // Image to send
            "image" => [
                "url" => "https://i.pinimg.com/736x/52/61/8c/52618cd73525780c5fb7c214b4c2859c.jpg"
            ],

            // Thumbnail
            //"thumbnail" => [
            //    "url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=400"
            //],

            // Author
            "author" => [
                "name" => "Black Rose",
                "url" => "https://isadashboard.000webhostapp.com"
            ],

            // Additional Fields array
            "fields" => [
                // Field 1
                [
                    "name" => "Note",
                    "value" => $ann,
                    "inline" => false
                ],
                // Field 2
                [
                    "name" => "Submitted By",
                    "value" => $name,
                    "inline" => true
                ]
                // Etc..
            ]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


$ch = curl_init( $webhookurl );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
// If you need to debug, or find out why you can't send message uncomment line below, and execute script.
 echo $response;
curl_close( $ch );*/


?>
