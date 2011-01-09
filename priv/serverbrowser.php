<h1>Choose game!</h1>

<?php

//manage players (kick disconnected)
//No "1 player on server" situation
$time = time();
$time = $time - 15;
$result = query("SELECT * FROM users WHERE world <> '' AND lasthit < '$time'");

if(mysql_num_rows($result) > 0){
    $player_name  = mysql_result($result,0,"username");
    $player_world = mysql_result($result,0,"world");
    query("UPDATE users SET world = '' WHERE username = '$player_name'");
    query("INSERT INTO feed(target,owner,message,unixtime) VALUES('\{$player_world\}','system','$player_name ping timeout!','$time')");
}


$result = query("SELECT * FROM worlds");
$count  = mysql_num_rows($result);

echo("<ul>");

for($i = 0;$i < $count;$i++){
    $name = mysql_result($result,$i,"name");
    $desc = mysql_result($result,$i,"desc");

    $result2 = query("SELECT * FROM users WHERE world = '$name'");
    $players = mysql_num_rows($result2);

    echo("<li><a href='index.php?action=world&subaction=join&name=$name'><b>$name</b></a> $desc | $players players</li>");
}
echo("</ul>");
?>
