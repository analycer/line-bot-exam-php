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

var_dump( $httpClient );
var_dump( $bot );
var_dump( $textMessageBuilder );
var_dump( $response );

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();







