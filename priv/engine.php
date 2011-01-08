<?php
$action = $_GET['action'];

switch($action){
    case "msg":
        include("priv/engine/msg.php");
        break;
    case "world":
        include("priv/engine/world.php");
        break;
    default:
        include("priv/engine/dashboard.php");
        break;
}
?>
