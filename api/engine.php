<?php
if($auth_ok == 0){
    die("Auth error");
}
$action = $_GET['action'];
switch($action){
    case "live":
        include("engine/live.php");
        break;
    case "worldview":
        include("engine/worldview.php");
        break;
    case "move":
        include("engine/move.php");
        break;
    case "editor":
        include("engine/editor.php");
        break;
    default:
        echo("Apiloginok\n");
}
?>
