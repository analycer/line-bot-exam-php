<?php

require "tokens.php";
require "vendor/autoload.php";

$access_token = $token_access;
$channelSecret = $token_channel;
$pushID = $token_id; // user id

$user_ids = array('Ua0c0cd1ee5061638a0264e9b12041b78','Ua0c0cd1ee5061638a0264e9b12041b78'); // users to send msg to

$msg = 'hello world';
if (!empty($_GET["msg"])) $msg = $_GET["msg"]; 

// Construct CLIENT / BOT / MESSAGE
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($msg);

// Send to all users
foreach ($user_ids as $id) 
    $response = $bot->pushMessage($id, $textMessageBuilder);


// echo "<pre>";
// var_dump( $httpClient );
// echo "<hr>";
// var_dump( $bot );
// echo "<hr>";
// var_dump( $textMessageBuilder );
// echo "<hr>";
// var_dump( $response );
// echo "<hr>";

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();