<?php
$action = $_GET['action'];

switch($action){
    default:
        include("priv/engine/dashboard.php");
        break;
}
?>
