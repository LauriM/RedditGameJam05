<?php
$input = $_POST['message'];
$input = secure($input);
$time = time();

query("INSERT INTO feed(target,message,unixtime,owner) VALUES('[GLOBAL]','$input','$time','$username');");
echo("ok done redirect or something here");
?>
