<?php

require "tokens.php"; 
require "vendor/autoload.php";

$access_token = $token_access;
$channelSecret = $token_channel;
$pushID = $token_id; // user id


// ------------------------- DEFAULTS / FORM ---------------------------------------
$id = '';
$msg = '';
if (!empty($_GET["msg"])) $msg = $_GET["msg"]; 
if (!empty($_GET["receiver"])) $receiver = $_GET["receiver"]; 


// -------------------------- Construct CLIENT / BOT / MESSAGE -----------------------
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($msg);

// ----------------------------- Send to all users -----------------------------------
//foreach ($user_ids as $id) 
$response = $bot->pushMessage($receiver, $textMessageBuilder);


//echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
if ($response->getHTTPStatus() == 200) 
    echo "<font color='ForestGreen'>ส่งข้อความแล้ว</font><br>$msg";
else {
    echo "<font color='red'>ไม่สามารถส่งข้อความได้ </font><hr><pre>";
    // var_dump( $httpClient );
    // var_dump( $bot );
    var_dump( $textMessageBuilder ); echo "<hr>";
    var_dump( $response );
}