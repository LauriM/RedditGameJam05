<?php
include("../config.php");
include("../system/database.php");
include("../system/functions.php");
include("../system/napalmauth.class.php");


$napalmauth = new NapalmAuth();
$napalmauth->init();

if($api_enable == false){
	die("API DISABLED!");
}

$status = $napalmauth->api_auth();
if($status == 1){
    $auth_ok = true;
    include("engine.php");
}else{
    echo("autherror");
}
?>
