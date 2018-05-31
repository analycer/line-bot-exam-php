<?php



require "vendor/autoload.php";

$access_token = 'QL1eDf9RyBtwa/OgMx/h/ZrMeYIEPcZpqHeFHjJ3youZCtPNup1sCmD3l8NI2Mo7ZUQJve4EFPoGXFcJ3qIi8HXN51tYRLvbGkLLCYWtM6JZSTk9ldiyof/5fA3F2CGZOVHODTzfjKrYVbkeYI4gIgdB04t89/1O/w1cDnyilFU=';

$channelSecret = 'a4a9a5b45e89af6ee640b5be50cc0090';

$pushID = 'Ua0c0cd1ee5061638a0264e9b12041b78';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();







