<?php
//spawn objects
$result = query("SELECT * FROM objects WHERE world = '$user_world'");
$count  = mysql_num_rows($result);

if($count == 0){
    $spawncount = rand(3,7);

    for($i = 0;$i < $spawncount;$i++){
        $x = rand(0,9);
        $y = rand(0,9);
        $result2 = query("SELECT * FROM world WHERE world = '$user_world' AND posx = '$x' AND posy = '$y' AND clip = '1'");
        if(mysql_num_rows($result2) == 0){//dont spawn on clip tile
            query("INSERT INTO objects(world,posx,posy,type) VALUES('$user_world','$x','$y','1')");
        }
    }
}

//manage players (kick disconnected)
$time = time();
$time = $time - 15;
$result = query("SELECT * FROM users WHERE world <> '' AND lasthit < '$time'");

if(mysql_num_rows($result) > 0){
    $player_name  = mysql_result($result,0,"username");
    $player_world = mysql_result($result,0,"world");
    query("UPDATE users SET world = '' WHERE username = '$player_name'");
    query("INSERT INTO feed(target,owner,message,unixtime) VALUES('\{$player_world\}','system','$player_name ping timeout!','$time')");
}
?>
