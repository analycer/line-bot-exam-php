<?php

require "tokens.php"; 
require "vendor/autoload.php";

$access_token = $token_access;
$channelSecret = $token_channel;
$pushID = $token_id; // user id

$GROUP_ID_STOCK = 'C56051d42887f2c8787eff2909f348536';

//$user_ids = array('Ua0c0cd1ee5061638a0264e9b12041b78','Cfbf49c7e3fd9c4ab11e6a26d42a4bb18'); // users , groups to send msg to

// ------------------------- DEFAULTS / FORM ---------------------------------------
$id = '';
$msg = '';
if (!empty($_GET["msg"])) $msg = $_GET["msg"]; 
if (!empty($_GET["receiver"])) $receiver = $_GET["receiver"]; 

switch ($receiver) {
    case 'stock': $id = $GROUP_ID_STOCK; break;
}

// -------------------------- Construct CLIENT / BOT / MESSAGE -----------------------
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($msg);

// ----------------------------- Send to all users -----------------------------------
//foreach ($user_ids as $id) 
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