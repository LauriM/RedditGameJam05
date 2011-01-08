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

<table border="1">
    <tr>
        <td>
        </td>
        <td>
            <a id="moven">N</a>
        </td>
        <td>
        </td>
    </tr>
    <tr>
        <td>
            <a id="movew">w</a>
        </td>
        <td>
        </td>
        <td>
            <a id="movee">e</a>
        </td>
    </tr>
    <tr>
        <td>
        </td>
        <td>
            <a id="moves">s</a>
        </td>
        <td>
        </td>
    </tr>
</table>
