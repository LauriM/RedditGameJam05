<?php
$result = query("SELECT * FROM objects WHERE world = '$user_world'");
$count  = mysql_num_rows($result);

if($count == 0){
    $spawncount = rand(3,7);

    for($i = 0;$i < $spawncount;$i++){
        $x = rand(0,9);
        $y = rand(0,9);
        query("INSERT INTO objects(world,posx,posy,type) VALUES('$user_world','$x','$y','1')");
    }
}
?>
