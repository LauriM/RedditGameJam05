<?php
if($auth_ok == 0){
    die("Auth error");
}

$action = $_GET['action'];

switch($action){
    case "live":
        include("engine/live.php");
    default:
        echo("Apiloginok\n");
}
?>
