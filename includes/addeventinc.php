<?php
 
session_start();
require_once'../connections/connect.php';

date_default_timezone_set("America/Chicago");

$date = date("Y/m/d");
$time = date("h:i:sa");

$datetime = $date . ' ' . $time;



$userID =  $_SESSION['userid'];

$eventName = $_POST['eventname'];

$eventstartdate = $_POST['eventstartdate'];
$eventenddate = $_POST['eventenddate'];



$sql = "INSERT INTO events (eventName, userID, dateStart, club, dateEnd)  VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_stmt_init($link);
if(!mysqli_stmt_prepare($stmt, $sql)){
    echo "SQL Error";
}else{
    mysqli_stmt_bind_param($stmt, "sssss", $eventName, $userID, $eventstartdate, $_SESSION['currentclub'], $eventenddate);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    header("location:../home.php");
}

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
