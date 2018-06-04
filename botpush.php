<?php

require "tokens.php";

require "vendor/autoload.php";

$access_token = $token_access;

$channelSecret = $token_channel;

$pushID = $token_id; // user id

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->pushMessage($pushID, $textMessageBuilder);

echo "<pre>";
var_dump( $httpClient );
echo "<hr>";
var_dump( $bot );
echo "<hr>";
var_dump( $textMessageBuilder );
echo "<hr>";
var_dump( $response );
echo "<hr>";

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();







