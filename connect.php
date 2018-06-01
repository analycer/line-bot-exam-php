<?php

	//$host = "admin.shininggold.com";
	//$host = "119.81.10.21"; // softlayer
	$host = "128.199.113.243";
	
	$user 	= "champ";
	$pw 	= "ieteroop";
	
	$dbname ="shining_prod";
	
	$connection = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pw");
	
	if (!$connection)
		@(die ("<font size='5' color=red> ไม่สามารถติดต่อฐานข้อมูลได้ กรุณาแจ้งผู้ดูแลระบบ </font>" . pg_last_error($conn))); 
 