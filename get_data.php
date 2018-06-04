<?php

require ("tokens.php");
$access_token = $token_access;


$mode = 'user';
if (!empty($_GET["mode"])) $mode = $_GET["mode"]; 
$id = $token_id;
if (!empty($_GET["id"])) $id = $_GET["id"]; 


switch ($mode) {
    case 'user':        $url = "https://api.line.me/v2/bot/profile/$id"; break;
    case 'group':       $url = "https://api.line.me/v2/bot/group/$id/members/ids"; break;
}


$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $ch."<hr>";

echo $result;