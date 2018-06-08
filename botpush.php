<?php

require "tokens.php"; 
require "vendor/autoload.php";

$access_token = $token_access;
$channelSecret = $token_channel;
$pushID = $token_id; // user id


//$user_ids = array('Ua0c0cd1ee5061638a0264e9b12041b78','Cfbf49c7e3fd9c4ab11e6a26d42a4bb18'); // users , groups to send msg to

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
$response = $bot->pushMessage($id, $textMessageBuilder);


//echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
if ($response->getHTTPStatus() == 200) 
    echo 'ส่งข้อความแล้ว';
else {
    echo 'ไม่สามารถส่งข้อความได้'."<hr><pre>";
    // var_dump( $httpClient );
    // var_dump( $bot );
    var_dump( $textMessageBuilder ); echo "<hr>";
    var_dump( $response );
}