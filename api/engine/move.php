<?php
//TODO: move to data table
$world_width = 10;
$world_height = 10;

$dir = $_GET['dir'];
$time = time();

$result = query("SELECT * FROM users WHERE username='$username'");
$count  = mysql_num_rows($result);

if($count == 1){
    $user_x     = mysql_result($result,0,"posx");
    $user_y     = mysql_result($result,0,"posy");
    $user_world = mysql_result($result,0,"world");
}else{
    die("Error on user profile!");
}

switch("$dir"){
    case "w":
        $x = $user_x - 1;
        $y = $user_y;
        break;
    case "e":
        $x = $user_x + 1;
        $y = $user_y;
        break;
    case "n":
        $x = $user_x;
        $y = $user_y - 1;
        break;
    case "s":
        $x = $user_x;
        $y = $user_y + 1;
        break;
}

if($x < 0){
    $x = 0;
    query("INSERT INTO feed(target,owner,message,unixtime) VALUES('<$username>','system','Can\'t move there!','$time')");
}
if($y < 0){
    $y = 0;
    query("INSERT INTO feed(target,owner,message,unixtime) VALUES('<$username>','system','Can\'t move there!','$time')");
}

if($x > $world_width){
    $y = $world_width;
    query("INSERT INTO feed(target,owner,message,unixtime) VALUES('<$username>','system','Can\'t move there!','$time')");
}

if($y > $world_height){
    $y = $world_height;
    query("INSERT INTO feed(target,owner,message,unixtime) VALUES('<$username>','system','Can\'t move there!','$time')");
}

$result = query("SELECT * FROM world WHERE world = '$user_world' AND posx = '$x' AND posy='$y' AND clip='1'");
if(mysql_num_rows($result) == 0){
    query("UPDATE users SET posx = '$x', posy = '$y' WHERE username = '$username'");
}else{
echo($napalmdata->getdata($username,"editor"));
    if($napalmdata->getdata($username,"editor") == 1){
        query("UPDATE users SET posx = '$x', posy = '$y' WHERE username = '$username'");
        query("INSERT INTO feed(target,owner,message,unixtime) VALUES('<$username>','system','Clip alert!','$time')");
    }else{
        query("INSERT INTO feed(target,owner,message,unixtime) VALUES('<$username>','system','Can\'t move there!','$time')");
    }
}

?>
