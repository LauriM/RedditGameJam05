<?php
//TODO: move to data table
$world_width = 10;
$world_height = 10;

$result = query("SELECT * FROM users WHERE username = '$username'");
$count  = mysql_num_rows($result);

if($count == 1){
    $user_x     = mysql_result($result,0,"posx");
    $user_y     = mysql_result($result,0,"posy");
    $user_world = mysql_result($result,0,"world");
}else{
    die("Error on user profile!");
}

$result_world = query("SELECT * FROM world WHERE world = '$user_world'");
$count_world  = mysql_num_rows($result_world);

$result_players = query("SELECT * FROM users WHERE world = '$user_world'");
$count_players  = mysql_num_rows($result_players);

echo("<table border='1'>");
for($y = 0;$y < $world_width;$y++){
    echo("<tr>");
    for($x = 0;$x < $world_height;$x++){

            //get tile
            $hit = false;
            for($i = 0;$i < $count_world;$i++){
                if($x == mysql_result($result_world,$i,"posx") AND $y == mysql_result($result_world,$i,"posy")){
                    $tile = mysql_result($result_world,$i,"tile");
                    echo("<td background='img/tile/tile$tile.bmp' width='21' height='21'>"); 
                    $hit = true;
                }
            }

            $tilefull = false;
            if($x == $user_x AND $y == $user_y){
                $tilefull = 1;
                echo("<img src='img/tile/tile0.bmp' border='0'/>");
            }

            //get players
            for($i = 0;$i < $count_players;$i++){
                if($x == mysql_result($result_players,$i,"posx") AND $y == mysql_result($result_players,$i,"posy")){
                    $player_name = mysql_result($result_players,$i,"username");
                    if($tilefull == false){
                        echo("<img src='img/tile/tile0.bmp'/>");
                        $tilefull = true;
                    }
                }
            }

            if($hit == false){
                echo("<img src='img/tile/tile0.bmp'/>"); 
            }

        echo("</td>");
    }
    echo("</tr>");
}
echo("</table>");
echo("<hr>");

$result = query("SELECT * FROM feed WHERE target = '<$username>' OR target = '[global]'");
$count  = mysql_num_rows($result);

$limit = $count - 10;
if($limit < 0){
    $limit = 0;
}

$result = query("SELECT * FROM feed WHERE target = '<$username>' OR target = '[global]' LIMIT $limit,10");
$count  = mysql_num_rows($result);


for($i = $count-1;$i > 0 ;$i--){
    $owner   = mysql_result($result,$i,"owner");
    $message = mysql_result($result,$i,"message");
    echo("<p><b>$owner</b>: $message</p>");
}

?>
