<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

require "tokens.php";

$access_token = $token_access;

// Get POST body content
$content = file_get_contents('php://input');

// Parse JSON
$events = json_decode($content, true);

// Validate parsed JSON data
if (!is_null($events['events'])) {

	// Loop through each event
	foreach ($events['events'] as $event) {
	
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
		
			// ----------------------- Get text sent -----------------------
			//$text = $event['source']['userId'];
			$inbound_message = $event['message']['text'];
		
			if (strpos($inbound_message, 'price') !== false) {
				require ('connect.php');
				require ('header.php');

				if (!$current_price = getCurrentPrice())
					$outbound_message = 'Unable to get price';
				else 
					$outbound_message = 'Spot: '.$current_price['spot_bid']." - ".$current_price['spot_ask']."\n";
					$outbound_message .= '96.5%: '.$current_price['g96_bid']." - ".$current_price['g96_ask']."\n";
					$outbound_message .= '99.99%: '.$current_price['g99lbma_bid']." - ".$current_price['g99lbma_ask']."\n";
				
			} else {
				//$outbound_message = $event['source']['userId'];
				$outbound_message = print_r($event);
			}
			
			// Get replyToken
			$replyToken = $event['replyToken']; // ต้องส่งกลับให้ใคร,​กลุ่มไหน

			//  Build message to reply back ≈
			$messages = [
				'type' => 'text',
				'text' => $outbound_message
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];

			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}

echo "OK";
