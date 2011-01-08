<?php
$cmd = $_GET['cmd'];

$result = query("SELECT * FROM users WHERE username='$username'");
$count  = mysql_num_rows($result);

if($count == 1){
    $user_x     = mysql_result($result,0,"posx");
    $user_y     = mysql_result($result,0,"posy");
    $user_world = mysql_result($result,0,"world");
}else{
    die("Error on user profile!");
}

$auth = $napalmdata->getdata("$username","editor");

if($auth == 1){
    switch($cmd){
        case "clipon":
            query("UPDATE world SET clip = 1 WHERE world = '$user_world' AND posx = '$user_x' AND posy = '$user_y'",1);
            break;
        case "clipoff":
            query("UPDATE world SET clip = 0 WHERE world = '$user_world' AND posx = '$user_x' AND posy = '$user_y'");
            break;
    }
}else{
    die("Error, no permission!");
}
?>
