<?php
$action = $_GET['action'];

switch($action){
    case "world":
        include("priv/engine/world.php");
        break;
    default:
        include("priv/engine/dashboard.php");
        break;
}
?>
