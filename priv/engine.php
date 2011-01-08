<?php
$action = $_GET['action'];

switch($action){
    case "msg":
        include("priv/engine/msg.php");
        break;
    default:
        include("priv/engine/dashboard.php");
        break;
}
?>
