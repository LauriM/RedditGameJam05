<?php
session_start();

include("../config.php");
include("../system/database.php");
include("../system/functions.php");
include("../system/napalmauth.class.php");
include("../system/napalmdata.class.php");

$napalmdata = new NapalmData();

$napalmauth = new NapalmAuth();
$napalmauth->init();

if($api_enable == false){
	die("API DISABLED!");
}

$napalmauth->user_process();
$status = $napalmauth->user_process();
$username = $napalmauth->user_name();

if($status !== 1){
    $status = $napalmauth->api_auth();
}

if($status == 1){
    $auth_ok = true;
    include("engine.php");
}else{
    echo("autherror");
}
?>
