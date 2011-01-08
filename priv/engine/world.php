<?php
$result = query("SELECT * FROM users WHERE username = '$username';"); 
$count  = mysql_num_rows($result);

if($count == 1){
    $user_x     = mysql_result($result,0,"posx");
    $user_y     = mysql_result($result,0,"posy");
    $user_world = mysql_result($result,0,"world");
}else{
    die("Userprofile duplicate id error! Contact admin");
}

if($user_world == ""){
    //no location
    //TODO: show world select (?)
    query("UPDATE users SET world = 'default' WHERE username = '$username'");
    $user_world = "default";
}
?>

<div id="worldview">
</div>

<div class="controls">
    <a id="movew">w</a>
</div>
